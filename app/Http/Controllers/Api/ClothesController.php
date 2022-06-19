<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Resources\ClotheResource;
    use App\Models\Clothe;
    use Illuminate\Http\JsonResponse;

    class ClothesController extends Controller
    {
        public function __construct() {
            $this->middleware('is.admin', [
                'only' => ['store']
            ]);
        }

        /**
         * @return JsonResponse
         */
        public function index(): JsonResponse {
            return response()->json([
                'data' => ClotheResource::collection(Clothe::all()),
            ]);
        }

        /**
         * Display the specified resource.
         *
         * @param Clothe $clothe
         * @return ClotheResource
         */
        public function show(Clothe $clothe): ClotheResource {
            return new ClotheResource($clothe);
        }

        public function store() {
            $clothe = Clothe::create(request()->only(['id', 'color', 'img', 'price']));
            return response()->json([
                'data' => new ClotheResource($clothe),
            ]);
        }
    }
