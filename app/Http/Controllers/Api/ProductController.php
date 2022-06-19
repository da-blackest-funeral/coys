<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Resources\ProductResource;
    use App\Models\Product;
    use Illuminate\Http\JsonResponse;

    class ProductController extends Controller
    {
        public function __construct() {
            $this->middleware('can.delete', [
                'only' => ['destroy']
            ]);
        }

        /**
         * Display a listing of the resource.
         *
         * @return JsonResponse
         */
        public function index(): JsonResponse {
            return response()->json([
                'data' => ProductResource::collection(
                    request()->user()->products()->get()->load('clothe')
                ),
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @return JsonResponse
         */
        public function store(): JsonResponse {
            return response()->json([
                'data' => Product::create([
                    'size' => request()->input('size'),
                    'user_id' => request()->user()->id,
                    'clothe_id' => request()->input('clothe_id'),
                ])
            ]);
        }

        /**
         * Display the specified resource.
         *
         * @param Product $product
         * @return ProductResource
         */
        public function show(Product $product): ProductResource {
            return new ProductResource($product);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param Product $product
         * @return JsonResponse
         */
        public function destroy(Product $product): JsonResponse {
            $product->delete();

            return response()->json([
                'message' => 'Deleted'
            ], 204);
        }
    }
