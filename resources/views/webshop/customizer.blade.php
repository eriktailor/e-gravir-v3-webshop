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
            </div>

            <!-- Content -->
            <div class="offcanvas-content flex-grow overflow-auto no-scrollbar p-6">
                
                <form action="{{ route('cart.customize', ['id' => $id]) }}" method="POST" id="productCustomizeForm" class="flex flex-col gap-y-4" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-group">
                        <input type="file" name="file" id="customizeFrontImage" required/>
                    </div>
                    <div class="form-group">
                        <x-form.input label="Előlap szöveg" for="customizeFrontText"/>
                    </div>
                    <div class="form-group">
                        <x-form.textarea label="Egyéb instrukció" for="customizeOtherNotes" rows="4"/>
                    </div>

                    <x-form.checkbox 
                        for="engrave_second_page" 
                        class="toggle"
                        data-target="#customizeBackPage">
                        A hátoldalra is kérek gravírozást <span class="text-gray-400">(+2900 Ft)</span>
                    </x-form.checkbox>
                    <div class="hidden" id="customizeBackPage">
                        <div class="form-group mb-4">
                            {{-- <x-form.upload 
                                for="front_image" 
                                id="customizeBackImage" 
                                label="Hátlap képe"
                                :config="['allowMultiple' => false, 'maxFiles' => 1]"
                            /> --}}
                        </div>
                        <div class="form-group">
                            <x-form.input label="Hátlap szöveg" for="customizeBackText"/>
                        </div>
                    </div>
                    
                    <x-form.checkbox 
                        for="engrave_third_page" 
                        class="toggle"
                        data-target="#customizeInnerPage">
                        A belső oldalra is kérek gravírozást <span class="text-gray-400">(+2900 Ft)</span>
                    </x-form.checkbox>
                    <div class="hidden" id="customizeInnerPage">
                        <div class="form-group">
                            <x-form.input label="Belső szöveg" for="customizeInnerText"/>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="offcanvas-footer flex-none p-6">
                <x-button href="#" class="button-submit w-full" data-target="#productCustomizeForm" data-product-id="{{ $id }}">Mentés</x-button>
            </div>
            

        </div>
    </div>
</aside>

@push('styles')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush
@push('scripts')
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script>
const inputElement = document.querySelector('#customizeFrontImage');
const pond = FilePond.create(inputElement, {
    allowProcess: false,
    storeAsFile: true // 👈 important! keeps real file for form submission
});
</script>
@endpush