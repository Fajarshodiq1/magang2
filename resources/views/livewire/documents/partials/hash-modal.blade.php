 <div id="hashModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
     <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeHashModal()"></div>

     <div class="flex items-center justify-center min-h-screen p-4">
         <div class="relative bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl w-full max-w-2xl"
             onclick="event.stopPropagation()">
             <div class="p-6 border-b border-gray-200 dark:border-zinc-700">
                 <div class="flex items-center justify-between">
                     <div>
                         <h3 class="text-xl font-bold text-gray-900 dark:text-white">Security Hash Information</h3>
                         <p id="hashModalTitle" class="text-sm text-gray-600 dark:text-gray-400 mt-1"></p>
                     </div>
                     <button onclick="closeHashModal()"
                         class="p-2 hover:bg-gray-100 dark:hover:bg-zinc-700 rounded-lg transition">
                         <i class="fas fa-times text-gray-500"></i>
                     </button>
                 </div>
             </div>

             <div class="p-6 space-y-4">
                 <!-- Document Hash -->
                 <div>
                     <div class="flex items-center justify-between mb-2">
                         <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                             <i class="fas fa-fingerprint mr-2 text-blue-500"></i>Document Hash (SHA-256)
                         </label>
                         <button onclick="copyHash('documentHash')"
                             class="text-xs text-blue-600 hover:text-blue-700 dark:text-blue-400 font-semibold">
                             <i class="fas fa-copy mr-1"></i>Copy
                         </button>
                     </div>
                     <code id="documentHash"
                         class="block w-full p-3 bg-gray-100 dark:bg-zinc-900 text-gray-800 dark:text-gray-300 rounded-lg text-xs font-mono break-all"></code>
                 </div>

                 <!-- File Checksum -->
                 <div>
                     <div class="flex items-center justify-between mb-2">
                         <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                             <i class="fas fa-shield-check mr-2 text-emerald-500"></i>File Checksum (MD5)
                         </label>
                         <button onclick="copyHash('fileChecksum')"
                             class="text-xs text-blue-600 hover:text-blue-700 dark:text-blue-400 font-semibold">
                             <i class="fas fa-copy mr-1"></i>Copy
                         </button>
                     </div>
                     <code id="fileChecksum"
                         class="block w-full p-3 bg-gray-100 dark:bg-zinc-900 text-gray-800 dark:text-gray-300 rounded-lg text-xs font-mono break-all"></code>
                 </div>

                 <!-- Info -->
                 <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                     <p class="text-xs text-blue-800 dark:text-blue-300">
                         <i class="fas fa-info-circle mr-1"></i>
                         <strong>Hash digunakan untuk:</strong> Memverifikasi integritas dokumen dan memastikan tidak
                         ada modifikasi yang dilakukan setelah dokumen diunggah.
                     </p>
                 </div>
             </div>
         </div>
     </div>
 </div>
