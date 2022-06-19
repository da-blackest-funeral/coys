<?php

    namespace App\Http\Resources;

    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
    use JetBrains\PhpStorm\ArrayShape;

    class ProductResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @param Request $request
         * @return array
         */
        #[ArrayShape(['id' => "mixed", 'created_at' => "mixed", 'clothe' => "\App\Http\Resources\ClotheResource", 'size' => "mixed"])]
        public function toArray($request): array {
            return [
                'id' => $this->id,
                'created_at' => $this->created_at,
                'clothe' => new ClotheResource($this->clothe),
                'size' => $this->size,
            ];
        }
    }
