@props([
    'for',
    'label' => null,
    'placeholder' => '',
    'value' => '',
])

<div class="form-control">
    
    @if($label)
        <label for="{{ $for }}" class="form-label">{{ $label }}</label>
    @endif

    <div 
        id="{{ $for }}Wrapper" 
        class="tag-input flex flex-wrap gap-2 input"
    >
        <input 
            type="text" 
            id="{{ $for }}Input" 
            class="border-none focus:border-none outline-none flex-1"
            placeholder="{{ $placeholder }}"
        >
    </div>

    <input 
        type="hidden" 
        name="{{ $for }}" 
        id="{{ $for }}" 
        value="{{ old($for, $value) }}"
    >

    <x-form.error :for="$for" />
    
</div>

@once('tags')
    @push('scripts')
        <script>
            $(document).ready(function(){
                function initTags(wrapper, input, hidden, initialValue) {
                    var tags = initialValue.length ? initialValue.split(',') : [];

                    function renderTags() {
                        $(wrapper + ' .tag-item').remove();
                        tags.forEach(function(tag){
                            $('<span class="tag-item">' 
                                + tag 
                                + '<span class="tag-remove">×</span></span>'
                            ).insertBefore(input);
                        });
                        $(hidden).val(tags.join(','));
                    }

                    renderTags();

                    $(input).on('keypress', function(e){
                        if(e.which == 44) { // Comma
                            e.preventDefault();
                            var val = $(this).val().trim();
                            if(val.length && !tags.includes(val)){
                                tags.push(val);
                                $(this).val('');
                                renderTags();
                            }
                        }
                    });

                    $(document).on('click', wrapper + ' .tag-remove', function(){
                        var index = $(this).parent().index();
                        tags.splice(index, 1);
                        renderTags();
                    });
                }

                // Init all instances
                @php
                    $id = $attributes->get('id') ?? $for;
                @endphp
                initTags('#{{ $id }}Wrapper', '#{{ $id }}Input', '#{{ $id }}', '{{ old($for, $value) }}');
            });
        </script>
    @endpush
@endonce
