<aside id="sideCustomizer" class="offcanvas fixed inset-0 z-50 invisible opacity-0 transition-opacity duration-300">

    <!-- BACKDROP -->
    <div class="offcanvas-backdrop absolute inset-0 bg-stone-950/50 opacity-0 transition-opacity duration-300"></div>

    <!-- PANEL -->
    <div class="offcanvas-panel absolute right-0 top-0 h-full w-full sm:w-[500px] transform translate-x-full transition-transform duration-300 ease-in-out p-8">
        <div class="bg-white rounded-xl h-full flex flex-col">

            <!-- Header -->
            <div class="offcanvas-header p-6 border-b border-gray-300 flex-none">
                <div class="flex justify-between">
                    <x-heading level="h2">Testreszabás</x-heading>
                    <x-button.chip icon="x" class="offcanvas-close"/>
                </div>
                <p class="text-gray-400 mt-3">A kosárban lévő termékeket a pénztár oldalon tudod majd személyre szabni.</p>
            </div>

            <!-- Content -->
            <div class="offcanvas-content flex-grow overflow-auto no-scrollbar p-6">
                
                <form action="" method="POST" id="productCustomizeForm" class="flex flex-col gap-y-4" novalidate>
                    @csrf
                    <div class="form-group">
                        <x-form.upload 
                            for="front_image" 
                            id="customizeFrontImage" 
                            label="Előlap képe"
                            multiple 
                            :config="['allowMultiple' => false, 'maxFiles' => 1]"
                        />
                    </div>
                    <div class="form-group">
                        <x-form.input label="Előlap szöveg" for="customizeFrontText"/>
                    </div>
                    <div class="form-group">
                        <x-form.upload 
                            for="front_image" 
                            id="customizeBackImage" 
                            label="Hátlap képe"
                            multiple 
                            :config="['allowMultiple' => false, 'maxFiles' => 1]"
                        />
                    </div>
                    <div class="form-group">
                        <x-form.input label="Hátlap szöveg" for="customizeBackText"/>
                    </div>
                    <div class="form-group">
                        <x-form.input label="Belső szöveg" for="customizeBackText"/>
                    </div>
                    <div class="form-group">
                        <x-form.textarea label="Egyéb instrukció" for="customizeBackText" rows="4"/>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="offcanvas-footer flex-none p-6">
                <x-button href="#" class="w-full">Mentés</x-button>
            </div>
            

        </div>
    </div>
</aside>