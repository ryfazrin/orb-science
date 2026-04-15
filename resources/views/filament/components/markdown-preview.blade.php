<div class="prose dark:prose-invert max-w-none bg-surface-container-low/50 dark:bg-gray-900 border border-surface-container shadow-inner rounded-xl p-6 min-h-[400px] relative mt-2 text-sm"
     x-data="{ contentId: 'markdown-preview-' + Math.random().toString(36).substring(7) }"
     x-init="
        $nextTick(() => {
            if (typeof renderMathInElement !== 'undefined') {
                renderMathInElement(document.getElementById(contentId), {
                    delimiters: [
                        {left: '$$', right: '$$', display: true},
                        {left: '$', right: '$', display: false}
                    ]
                });
            } else {
                // If KaTeX is not loaded yet, inject it manually for this admin view
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = 'https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css';
                document.head.appendChild(link);
                
                const script1 = document.createElement('script');
                script1.src = 'https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js';
                document.head.appendChild(script1);
                
                script1.onload = () => {
                    const script2 = document.createElement('script');
                    script2.src = 'https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js';
                    document.head.appendChild(script2);
                    
                    script2.onload = () => {
                        renderMathInElement(document.getElementById(contentId), {
                            delimiters: [
                                {left: '$$', right: '$$', display: true},
                                {left: '$', right: '$', display: false}
                            ]
                        });
                    };
                };
            }
        });
     "
>
    <!-- We generate the HTML string using Laravel's core markdown compiler so it mimics the final display -->
    <div :id="contentId">
        {!! Str::markdown($content ?: '*Mulai mengetik untuk melihat preview...*') !!}
    </div>
</div>
