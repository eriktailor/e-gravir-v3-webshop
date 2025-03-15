@php
    // Define the path to the SVG file
    $path = public_path('/icons/' . $name . '.svg');

    // Check if the SVG file exists
    if (file_exists($path)) {
        $svgContent = file_get_contents($path);

        // Modify the SVG tag with the passed attributes (class, stroke-width, etc.)
        $svgContent = preg_replace_callback('/<svg([^>]+)>/', function ($matches) use ($attributes) {
            
            // Merge provided attributes, like class and stroke-width, with any additional attributes
            $mergedAttributes = $attributes->merge([
                'stroke-width' => $strokeWidth ?? '1.5',  // Default stroke width if not passed
            ])->getAttributes();

            // Convert attributes array to a string for insertion
            $attributeString = collect($mergedAttributes)
                ->map(fn($value, $key) => $key . '="' . $value . '"')
                ->join(' ');

            // Return the <svg> tag with the merged attributes
            return '<svg ' . $attributeString . ' ' . $matches[1] . '>';
        }, $svgContent);
    } else {
        // Handle missing SVG gracefully
        $svgContent = '<!-- Icon not found: ' . e($name) . ' -->';
    }
@endphp

{!! $svgContent !!}
