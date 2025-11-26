// 폼 자동 저장 및 복원 기능
document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('form[data-autosave]')
    
    console.log('[Form Autosave] Found forms:', forms.length)
    
    forms.forEach(form => {
        const formId = form.dataset.autosave
        const storageKey = `form_${formId}`
        const isEdit = form.dataset.isEdit === 'true'
        
        console.log('[Form Autosave] Init:', { formId, storageKey, isEdit })
        
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
                    console.log('[Form Autosave] Clearing data:', storageKey)
                    clearFormData(storageKey)
                }
            }, 100)
        })
    })
})

function saveFormData(form, storageKey) {
    const data = {}
    const inputs = form.querySelectorAll('input:not([type="file"]):not([type="password"]):not([name="_token"]), textarea, select')
    
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
    
    console.log('[Form Autosave] Saving:', storageKey, data)
    localStorage.setItem(storageKey, JSON.stringify(data))   
}

function loadFormData(form, storageKey) {
    const savedData = localStorage.getItem(storageKey)
    
    console.log('[Form Autosave] Loading:', storageKey, savedData)
    
    if (!savedData) return
    
    // Edit 페이지인지 확인 (data-is-edit 속성으로)
    const isEdit = form.dataset.isEdit === 'true'
    
    console.log('[Form Autosave] Is edit page:', isEdit)
    
    try {
        const data = JSON.parse(savedData)
        
        Object.keys(data).forEach(name => {
            const input = form.querySelector(`[name="${name}"]`)
            if (!input) return
            
            // Edit 페이지: 빈 값일 때만 localStorage 적용
            // New 페이지: 항상 localStorage 적용
            const shouldLoad = isEdit ? (!input.value || input.value.trim() === '') : true
            
            console.log('[Form Autosave] Field:', name, { currentValue: input.value, savedValue: data[name], shouldLoad })
            
            if (shouldLoad) {
                if (input.type === 'checkbox') {
                    input.checked = data[name]
                } else if (input.type === 'radio') {
                    if (input.value === data[name]) {
                        input.checked = true
                    }
                } else {
                    input.value = data[name]
                }
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