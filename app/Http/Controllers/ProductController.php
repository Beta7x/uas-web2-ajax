<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // set index page view
	public function index() {
		return view('index');
	}

	// handle fetch all eamployees ajax request
	public function fetchAll() {
		$products = Product::all();
		$output = '';
		if ($products->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Series</th>
                <th>Production Year</th>
                <th>Price</th>
                <th>Operting System</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($products as $product) {
				$output .= '<tr>
                <td>' . $product->id . '</td>
                <td>' . $product->brand . '</td>
                <td>' . $product->series . '</td>
                <td>' . $product->production_year . '</td>
                <td>' . $product->price . '</td>
                <td>' . $product->operating_system . '</td>
                <td>
                  <a href="#" id="' . $product->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $product->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h4 class="text-center text-secondary my-5">No record present in the database!</h4>';
		}
	}

	// handle insert a new productloyee ajax request
	public function store(Request $request) {
		
		$productData = ['brand' => $request->brand, 
                        'series' => $request->series, 
                        'production_year' => $request->production_year, 
                        'price' => $request->price, 
                        'operating_system' => $request->operating_system];
		Product::create($productData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle edit an productloyee ajax request
	public function edit(Request $request) {
		$id = $request->id;
		$product = Product::find($id);
		return response()->json($product);
	}

	// handle update an productloyee ajax request
	public function update(Request $request) {
		$product = Product::find($request->product_id);
		$productData = ['brand' => $request->brand, 
                        'series' => $request->series, 
                        'production_year' => $request->production_year, 
                        'price' => $request->price, 
                        'operating_system' => $request->operating_system];
		$product->update($productData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle delete an productloyee ajax request
	public function delete(Request $request) {
		$id = $request->id;
		$product = Product::find($id);
        Product::destroy($id);
	}
}
