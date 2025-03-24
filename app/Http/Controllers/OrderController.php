<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display admin orders listing
     */
    public function index(Request $request)
    {
        $query = Order::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                ->orWhere('customer_email', 'like', "%{$search}%")
                ->orWhere('customer_phone', 'like', "%{$search}%")
                ->orWhere('id', $search);
            });
        }

        $orders = $query->with('items')->latest()->get();

        if ($request->ajax()) {
            return view('admin.orders.list', compact('orders'))->render();
        }

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order. (optional)
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // Validation & storing logic
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            // add more fields...
        ]);

        $order = Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Rendelés létrehozva!');
    }

    /**
     * Display order single page
     */
    public function show(Order $order)
    {
        $order->load(['items.product.images', 'customizations']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            // add more fields...
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Rendelés frissítve!');
    }
    
    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:' . implode(',', array_keys(config('checkout.order_statuses')))],
        ]);

        $order->status = $validated['status'];
        $order->save();

        return redirect()->back()->with('success', 'Rendelés státusza frissítve!');
    }

    /**
     * Download all images of an order (in a zip file)
     */
    public function downloadImages(Order $order)
    {
        $zipFileName = 'order_'.$order->id.'_images.zip';
        $zip = new ZipArchive;
        $tempZip = storage_path('app/public/' . $zipFileName);

        if ($zip->open($tempZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            
            foreach ($order->items as $item) {
                $custom = $order->customizations->firstWhere('product_id', $item->product_id);

                if ($custom) {
                    $folderName = 'Product_' . $item->product_id;
                    
                    foreach (['front_image', 'back_image'] as $field) {
                        if (!empty($custom->$field)) {
                            $imagePath = storage_path('app/public/' . $custom->$field);
                            if (file_exists($imagePath)) {
                                $zip->addFile($imagePath, $folderName . '/' . basename($custom->$field));
                            }
                        }
                    }
                }
            }

            $zip->close();

        } else {
            return back()->with('error', 'Nem sikerült létrehozni a zip fájlt!');
        }

        // Letöltés
        return response()->download($tempZip)->deleteFileAfterSend(true);
    }
}
