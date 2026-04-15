<x-filament-panels::page>
    <div class="space-y-6">
        <div class="p-6 bg-white rounded-xl border border-gray-200 dark:bg-gray-900 dark:border-gray-800 shadow-sm">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Dasar Penulisan Markdown</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Sintaks Anda (Ketik Ini)</h3>
                    <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg text-sm font-mono text-gray-800 dark:text-gray-200">
# Heading 1 (Judul Utama)
## Heading 2 (Sub-Judul)
### Heading 3

**Teks tebal (Bold)**
*Teks Miring (Italic)*

- Item list pertama
- Item list kedua
  - Sub-item (Tekan tab/spasi)

1. Daftar bernomor
2. Daftar bernomor (lanjutan)

&gt; Teks Kutipan (Blockquote)
                    </pre>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Hasil di Layar Siswa (Preview)</h3>
                    <div class="prose dark:prose-invert max-w-none bg-gray-50 dark:bg-gray-800/50 p-4 rounded-lg border border-dashed border-gray-300 dark:border-gray-700">
                        <h1 class="text-2xl font-bold mt-0">Heading 1 (Judul Utama)</h1>
                        <h2 class="text-xl font-bold">Heading 2 (Sub-Judul)</h2>
                        <h3 class="text-lg font-bold">Heading 3</h3>
                        <p><strong>Teks tebal (Bold)</strong><br><em>Teks Miring (Italic)</em></p>
                        <ul class="list-disc pl-5 my-2"><li>Item list pertama</li><li>Item list kedua<ul class="list-disc pl-5"><li>Sub-item</li></ul></li></ul>
                        <ol class="list-decimal pl-5 my-2"><li>Daftar bernomor</li><li>Daftar bernomor (lanjutan)</li></ol>
                        <blockquote class="border-l-4 border-gray-300 pl-4 my-2 italic text-gray-600 dark:text-gray-400">Teks Kutipan (Blockquote)</blockquote>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl border border-blue-200/50 dark:bg-gray-900 dark:border-blue-900/30 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">PREMIUM FEATURE</div>
            <h2 class="text-xl font-bold mb-4 text-blue-800 dark:text-blue-400 flex items-center gap-2">
                <x-heroicon-o-variable class="w-6 h-6" /> Panduan Rumus Matematika (KaTeX)
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-4 text-sm">Platform ini ditenagai mesin KaTeX profesional. Gunakan simbol dollar <code class="bg-gray-100 dark:bg-gray-800 px-1 py-0.5 rounded text-red-500 font-mono">$$</code> untuk memicu rendering persamaaan saintifik dan logika.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Sintaks Anda (Ketik Ini)</h3>
                    <pre class="overflow-auto bg-gray-100 dark:bg-gray-800 p-4 rounded-lg text-sm font-mono text-gray-800 dark:text-gray-200">
Rumus sejajar dalam kalimat (Inline):
Sisi miring segitiga adalah $ c = \sqrt{a^2 + b^2} $ jika sisi tegak diketahui.

Rumus terpusat ukuran besar (Block Matrix):
Teori Gravitasi Newton:
$$ F = G \frac{m_1 m_2}{r^2} $$

Fungsi Trigonometri Kompleks:
$$ \sin(\alpha \pm \beta) = 
\sin \alpha \cos \beta \pm \cos \alpha \sin \beta $$
                    </pre>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Hasil di Layar Siswa (Preview)</h3>
                    <div id="katex-preview-container" class="max-w-none bg-blue-50/50 dark:bg-blue-900/10 p-4 rounded-lg border border-dashed border-blue-200 dark:border-blue-800/50 relative text-sm dark:text-gray-300 text-gray-800">
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
                        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
                        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.getElementById('katex-preview-container'), {delimiters: [{left: '$$', right: '$$', display: true}, {left: '$', right: '$', display: false}]});"></script>

                        Rumus sejajar dalam kalimat (Inline):<br>
                        <span class="inline-block my-1">Sisi miring segitiga adalah $ c = \sqrt{a^2 + b^2} $ jika sisi tegak diketahui.</span>
                        <br><br>
                        Rumus terpusat ukuran besar (Block Matrix):<br>
                        Teori Gravitasi Newton:
                        $$ F = G \frac{m_1 m_2}{r^2} $$
                        <br>
                        Fungsi Trigonometri Kompleks:
                        $$ \sin(\alpha \pm \beta) = \sin \alpha \cos \beta \pm \cos \alpha \sin \beta $$
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
