<div {{ $attributes }}>
    <div class="flex justify-around flex-wrap">
        <a class="border-2 duration-200 ease inline-flex items-center mr-1 transition p-1 rounded-full text-white border-gray-600 bg-gray-600 hover:bg-[#1877f2] hover:border-[#1877f2]" target="_blank" rel="noopener" href="https://facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" aria-label="Share on Facebook">
            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
            <title>Facebook</title>
            <path d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z">
            </path>
            </svg>
        </a>
        <a class="border-2 duration-200 ease inline-flex items-center mr-1 transition p-1 rounded-full text-white border-gray-600 bg-gray-600 hover:bg-black hover:border-black" target="_blank" rel="noopener" href="https://x.com/intent/tweet?url={{ urlencode($url) }}&amp;text={{ urlencode($text) }}" aria-label="Share on X">
            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="-100 -100 1400 1427" class="w-4 h-4">
                <path d="M714.163 519.284L1160.89 0H1055.03L667.137 450.887L357.328 0H0L468.492 681.821L0 1226.37H105.866L515.491 750.218L842.672 1226.37H1200L714.137 519.284H714.163ZM569.165 687.828L521.697 619.934L144.011 79.6944H306.615L611.412 515.685L658.88 583.579L1055.08 1150.3H892.476L569.165 687.854V687.828Z" fill="white"/>
            </svg>
        </a>
<?php /*
        <a class="border-2 duration-200 ease inline-flex items-center mr-1 transition p-1 rounded-full text-white border-gray-600 bg-gray-600 hover:bg-[#1da1f2] hover:border-[#1da1f2]" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&amp;text={{ urlencode($text) }}" aria-label="Share on Twitter">
            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
            <title>Twitter</title>
            <path d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z">
            </path>
            </svg>
        </a> */ ?>
        <a class="border-2 duration-200 ease inline-flex items-center mr-1 transition p-1 rounded-full text-white border-gray-600 bg-gray-600 hover:bg-[#0a66c2] hover:border-[#0a66c2]" target="_blank" rel="noopener" href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode($url) }}&amp;title={{ urlencode($text) }}&amp;summary={{ urlencode($text) }}&amp;source={{ urlencode($url) }}" aria-label="Share on Linkedin">
            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
            <title>Linkedin</title>
            <path d="M136 183v283H42V183h94zm6-88c1 27-20 49-53 49-32 0-52-22-52-49 0-28 21-49 53-49s52 21 52 49zm333 208v163h-94V314c0-38-13-64-47-64-26 0-42 18-49 35-2 6-3 14-3 23v158h-94V183h94v41c12-20 34-48 85-48 62 0 108 41 108 127z">
            </path>
            </svg>
        </a>
        <a class="border-2 duration-200 ease inline-flex items-center mr-1 transition p-1 rounded-full text-white border-gray-600 bg-gray-600 hover:bg-[#bd081c] hover:border-[#bd081c]" target="_blank" rel="noopener" href="https://pinterest.com/pin/create/button/?url={{ urlencode($url) }}&amp;media={{ urlencode($url) }}&amp;description={{ urlencode($text) }}" aria-label="Share on Pinterest" draggable="false">
            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
            <title>Pinterest</title>
            <path d="M268 6C165 6 64 75 64 186c0 70 40 110 64 110 9 0 15-28 15-35 0-10-24-30-24-68 0-81 62-138 141-138 68 0 118 39 118 110 0 53-21 153-90 153-25 0-46-18-46-44 0-38 26-74 26-113 0-67-94-55-94 25 0 17 2 36 10 51-14 60-42 148-42 209 0 19 3 38 4 57 4 3 2 3 7 1 51-69 49-82 72-173 12 24 44 36 69 36 106 0 154-103 154-196C448 71 362 6 268 6z">
            </path>
            </svg>
        </a>
        <a class="border-2 duration-200 ease inline-flex items-center mr-1 transition p-1 rounded-full text-white border-gray-600 bg-gray-600 hover:bg-[#ff4500] hover:border-[#ff4500]" target="_blank" rel="noopener" href="https://reddit.com/submit/?url={{ urlencode($url) }}&amp;resubmit=true&amp;title={{ urlencode($text) }}" aria-label="Share on Reddit" draggable="false">
            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
            <title>Reddit</title>
            <path d="M440 204c-15 0-28 6-38 15-35-24-83-40-137-42l28-125 88 20c0 22 18 39 39 39 22 0 40-18 40-39s-17-40-40-40c-15 0-28 9-35 22l-97-22c-5-1-10 3-11 7l-31 138c-53 2-100 18-136 43a53 53 0 0 0-38-16c-56 0-74 74-23 100l-3 24c0 84 95 152 210 152 117 0 211-68 211-152 0-8-1-17-3-25 50-25 32-99-24-99zM129 309a40 40 0 1 1 80 0 40 40 0 0 1-80 0zm215 93c-37 37-139 37-176 0-4-3-4-9 0-13s10-4 13 0c28 28 120 29 149 0 4-4 10-4 14 0s4 10 0 13zm-1-54c-22 0-39-17-39-39a39 39 0 1 1 39 39z">
            </path>
            </svg>
        </a>
        <a class="border-2 duration-200 ease inline-flex items-center mr-1 transition p-1 rounded-full text-white border-gray-600 bg-gray-600 hover:bg-[#25d366] hover:border-[#25d366]" target="_blank" rel="noopener" href="https://wa.me/?text={{ urlencode($text) }}%20{{ urlencode($url) }}" aria-label="Share on Whatsapp" draggable="false">
            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
            <title>Whatsapp</title>
            <path d="M413 97A222 222 0 0 0 64 365L31 480l118-31a224 224 0 0 0 330-195c0-59-25-115-67-157zM256 439c-33 0-66-9-94-26l-7-4-70 18 19-68-4-7a185 185 0 0 1 287-229c34 36 56 82 55 131 1 102-84 185-186 185zm101-138c-5-3-33-17-38-18-5-2-9-3-12 2l-18 22c-3 4-6 4-12 2-32-17-54-30-75-66-6-10 5-10 16-31 2-4 1-7-1-10l-17-41c-4-10-9-9-12-9h-11c-4 0-9 1-15 7-5 5-19 19-19 46s20 54 23 57c2 4 39 60 94 84 36 15 49 17 67 14 11-2 33-14 37-27s5-24 4-26c-2-2-5-4-11-6z">
            </path>
            </svg>
        </a>
        <a class="border-2 duration-200 ease inline-flex items-center mr-1 transition p-1 rounded-full text-white border-gray-600 bg-gray-600 hover:bg-[#0088cc] hover:border-[#0088cc]" target="_blank" rel="noopener" href="https://telegram.me/share/url?text={{ urlencode($text) }}&amp;url={{ urlencode($url) }}" aria-label="Share on Telegram" draggable="false">
            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
            <title>Telegram</title>
            <path d="M256 8a248 248 0 1 0 0 496 248 248 0 0 0 0-496zm115 169c-4 39-20 134-28 178-4 19-10 25-17 25-14 2-25-9-39-18l-56-37c-24-17-8-25 6-40 3-4 67-61 68-67l-1-4-5-1q-4 1-105 70-15 10-27 9c-9 0-26-5-38-9-16-5-28-7-27-16q1-7 18-14l145-62c69-29 83-34 92-34 2 0 7 1 10 3l4 7a43 43 0 0 1 0 10z">
            </path>
            </svg>
        </a>
        <a class="border-2 duration-200 ease inline-flex items-center mr-1 transition p-1 rounded-full text-white border-gray-600 bg-gray-600 hover:bg-[#e94826] hover:border-[#e94826]" target="_blank" rel="noopener" href="mailto:?subject={{ urlencode($text) }}&amp;body={{ urlencode($url) }}" aria-label="Share by Email" draggable="false">
            <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
            <title>Email</title>
            <path d="M464 64a48 48 0 0 1 29 86L275 314c-11 8-27 8-38 0L19 150a48 48 0 0 1 29-86h416zM218 339c22 17 54 17 76 0l218-163v208c0 35-29 64-64 64H64c-35 0-64-29-64-64V176l218 163z">
            </path>
            </svg>
        </a>
    </div>
</div>