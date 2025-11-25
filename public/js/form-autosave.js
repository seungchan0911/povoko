// 폼 자동 저장 및 복원 기능
document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('form[data-autosave]')
    
    forms.forEach(form => {
        const formId = form.dataset.autosave
        const storageKey = `form_${formId}`
        
        // 폼 데이터 로드
        loadFormData(form, storageKey)
        
        // 입력 시 자동 저장
        const inputs = form.querySelectorAll('input:not([type="file"]), textarea, select')
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                saveFormData(form, storageKey)
            })
            
            input.addEventListener('change', () => {
                saveFormData(form, storageKey)
            })
        })
        
        // 파일 입력 처리 (파일명만 저장)
        const fileInputs = form.querySelectorAll('input[type="file"]')
        fileInputs.forEach(input => {
            input.addEventListener('change', (e) => {
                const fileName = e.target.files[0]?.name || ''
                if (fileName) {
                    localStorage.setItem(`${storageKey}_file_${input.name}`, fileName)
                }
                saveFormData(form, storageKey)
            })
        })
        
        form.addEventListener('submit', (e) => {
            setTimeout(() => {
                if (document.querySelector('.alert-success, .success-message')) {
                    clearFormData(storageKey)
                }
            }, 100)
        })
    })
})

function saveFormData(form, storageKey) {
    const data = {}
    const inputs = form.querySelectorAll('input:not([type="file"]):not([type="password"]), textarea, select')
    
    inputs.forEach(input => {
        if (input.name) {
            if (input.type === 'checkbox') {
                data[input.name] = input.checked
            } else if (input.type === 'radio') {
                if (input.checked) {
                    data[input.name] = input.value
                }
            } else {
                data[input.name] = input.value
            }
        }
    })
    
    localStorage.setItem(storageKey, JSON.stringify(data))   
}

function loadFormData(form, storageKey) {
    const savedData = localStorage.getItem(storageKey)
    if (!savedData) return
    
    try {
        const data = JSON.parse(savedData)
        
        Object.keys(data).forEach(name => {
            const input = form.querySelector(`[name="${name}"]`)
            if (!input) return
            
            // Edit 페이지에서 기존 값이 있으면 localStorage 무시
            if (input.value && input.value.trim() !== '') {
                return
            }
            
            if (input.type === 'checkbox') {
                input.checked = data[name]
            } else if (input.type === 'radio') {
                if (input.value === data[name]) {
                    input.checked = true
                }
            } else {
                input.value = data[name]
            }
        })
        
    } catch (e) {
        console.error('Failed to load form data:', e)
    }
}

function clearFormData(storageKey) {
    localStorage.removeItem(storageKey)
    
    const keys = Object.keys(localStorage)
    keys.forEach(key => {
        if (key.startsWith(`${storageKey}_file_`)) {
            localStorage.removeItem(key)
        }
    })
}