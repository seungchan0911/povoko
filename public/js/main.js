import LocomotiveScroll from 'https://esm.sh/locomotive-scroll'

// 전역 변수로 scroll 선언
let scroll = null;

// 로딩 애니메이션 - 모든 페이지에 적용 (admin 제외)
const currentPage = document.body.dataset.page
if (currentPage !== 'admin') {
    const loadingScreen = document.querySelector('.loading-screen')
    const loadingText = document.querySelector('.loading-text')
    
    if (loadingScreen && loadingText) {
        let progress = 0
        let targetProgress = 0
        let isLoaded = false
        const startTime = performance.now()
        const minLoadingTime = 800
        
        window.addEventListener('load', () => {
            const elapsedTime = performance.now() - startTime
            
            if (elapsedTime >= minLoadingTime) {
                isLoaded = true
                targetProgress = 100
            } else {
                setTimeout(() => {
                    isLoaded = true
                    targetProgress = 100
                }, minLoadingTime - elapsedTime)
            }
        })
        
        function updateLoading() {
            if (!isLoaded && targetProgress < 90) {
                targetProgress += Math.random() * 3
            }
            
            progress += (targetProgress - progress) * 0.1
            
            loadingText.textContent = Math.floor(progress) + '%'
            
            if (progress < 99.9) {
                requestAnimationFrame(updateLoading)
            } else {
                loadingText.textContent = '100%'
                setTimeout(() => {
                    loadingScreen.classList.add('hidden')
                }, 300)
            }
        }
        
        requestAnimationFrame(updateLoading)
    }
}

window.addEventListener("load", () => {
    if (currentPage === "home") {
        scroll = new LocomotiveScroll({
            el: document.querySelector('[data-scroll-container]'),
            smooth: true,
            lerp: 0.08,
            smartphone: {
                smooth: true,
                breakpoint: 0
            },
            tablet: {
                smooth: true
            }
        });
        controlDOM(scroll)
        initBackgroundVideos()
    } else {
        scroll = new LocomotiveScroll({
            el: document.querySelector('[data-scroll-container]'),
            smooth: true,
            lerp: 0.08,
            tablet: {
                smooth: true
            }
        });
        controlDOM(scroll)
        initBackgroundVideos()
    }
    
    // works 페이지에서도 remote 작동하게
    if (currentPage === "works") {
        initRemoteForWorks()
        changeFilmData()
    }
})

function controlDOM(scroll) {
    const header = document.querySelector("header")
    const isChecked = header?.querySelector("#remote")
    const remoteDisplay = document.querySelector(".remote-display")
    const section = document.querySelector("section")
    
    if (!header || !isChecked || !remoteDisplay || !section) return // 필수 요소가 없으면 종료
    
    const sectionHeight = section.offsetHeight

    scroll.on("scroll", (args) => {
        if (args.scroll.y >= sectionHeight - 25 && args.scroll.y < sectionHeight * 2 - 50) header.classList.add("activate")
        else header.classList.remove("activate")
    })

    isChecked.addEventListener("change", () => {
        if (isChecked.checked) {
            remoteDisplay.classList.add("activate")
            header.classList.remove("activate")
        } else {
            remoteDisplay.classList.remove("activate")
            header.classList.add("activate")
            if (scroll.scroll.instance.scroll.y >= sectionHeight - 25 && scroll.scroll.instance.scroll.y < sectionHeight * 2 - 50) header.classList.add("activate")
            else header.classList.remove("activate")
        }
    })
    
    window.addEventListener("scroll", () => {
        if (scrollY >= sectionHeight - 25 && scrollY < sectionHeight * 2 - 50) header.classList.add("activate")
        else header.classList.remove("activate")
    })
}

// works 페이지용 remote 컨트롤
function initRemoteForWorks() {
    const header = document.querySelector("header")
    const isChecked = header?.querySelector("#remote")
    const remoteDisplay = document.querySelector(".remote-display")
    
    if (!header || !isChecked || !remoteDisplay) return
    
    isChecked.addEventListener("change", () => {
        if (isChecked.checked) {
            remoteDisplay.classList.add("activate")
        } else {
            remoteDisplay.classList.remove("activate")
        }
    })
}

function changeFilmData() {
    const fixedFilmContainer = document.querySelector(".fixed-film")
    const fixedIframe = fixedFilmContainer?.querySelector("iframe")
    const textTitle = fixedFilmContainer?.querySelector(".text-01")
    const readMoreLink = fixedFilmContainer?.querySelector(".read-more a")
    
    if (!fixedIframe || !fixedFilmContainer) return // iframe 요소가 없으면 종료
    
    const filmList = document.querySelectorAll(".film-grid .film")
    let selected = null
    let isTransitioning = false // 전환 중인지 확인
    
    // 첫 번째 썸네일을 기본 선택으로 설정
    if (filmList.length > 0) {
        const firstFilm = filmList[0]
        selected = firstFilm
        firstFilm.querySelector("img").classList.add("selected")
    }

    filmList.forEach(film => {
      film.querySelector("img").addEventListener("click", (e) => {
        // 스크롤 맨 위로 - Locomotive Scroll이 있으면 사용, 없으면 네이티브 스크롤
        if (scroll && scroll.scrollTo) {
            scroll.scrollTo(0)
        } else {
            window.scrollTo({ top: 0, behavior: 'smooth' })
        }

        const videoUrl = film.dataset.video
        const title = film.dataset.title
        const content = film.dataset.content
        const workId = film.dataset.workId

        // 동일한 비디오면 무시
        if (fixedIframe.src === videoUrl && !isTransitioning) return
        // 이미 전환 중이면 무시
        if (isTransitioning) return

        if (selected) selected.querySelector("img").classList.remove("selected")
        selected = film
        selected.querySelector("img").classList.add("selected")
        
        isTransitioning = true
        
        // 1단계: 페이드아웃 (0.5초)
        fixedFilmContainer.style.transition = 'opacity 0.5s ease-in-out'
        fixedFilmContainer.style.opacity = 0
        
        // 2단계: 페이드아웃 완료 후 동영상 변경
        setTimeout(() => {
            fixedIframe.src = videoUrl
            
            if (textTitle) textTitle.textContent = title
            if (readMoreLink) {
                readMoreLink.href = `/works/${workId}`
                readMoreLink.dataset.workId = workId
            }
            
            // 3단계: iframe 로드 대기 후 페이드인 (0.5초)
            setTimeout(() => {
                fixedFilmContainer.style.opacity = 1
                
                // 전환 완료
                setTimeout(() => {
                    isTransitioning = false
                }, 500)
            }, 200) // iframe 로드 대기
        }, 500) // 페이드아웃 시간과 동일
      })
    })
}

// 배경 비디오 순환 기능
function initBackgroundVideos() {
    const video = document.querySelector('.bg-parallax')
    if (!video) return
    
    const videosData = video.dataset.videos
    if (!videosData) return
    
    let videos
    try {
        videos = JSON.parse(videosData)
    } catch (e) {
        console.error('Failed to parse videos data:', e)
        return
    }
    
    if (!videos || videos.length === 0) {
        console.log('No videos available')
        return
    }
    
    let currentIndex = 0
    
    // 첫 번째 비디오 로드
    video.src = videos[currentIndex]
    video.load()
    
    // 비디오 종료 시 다음 비디오로 전환
    video.addEventListener('ended', () => {
        currentIndex = (currentIndex + 1) % videos.length
        video.src = videos[currentIndex]
        video.load()
        video.play().catch(err => console.error('Play error:', err))
    })
    
    // 비디오 로드 에러 처리
    video.addEventListener('error', (e) => {
        console.error('Video load error:', videos[currentIndex], e)
        // 다음 비디오로 시도
        currentIndex = (currentIndex + 1) % videos.length
        if (currentIndex < videos.length && videos[currentIndex]) {
            video.src = videos[currentIndex]
            video.load()
            video.play().catch(err => console.error('Play error:', err))
        } else {
            console.error('All videos failed to load')
        }
    })
    
    // 자동 재생
    video.play().catch(err => console.error('Initial play error:', err))
}