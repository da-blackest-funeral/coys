<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
    use JetBrains\PhpStorm\ArrayShape;

    class ClotheResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @param Request $request
         * @return array
         */
        #[ArrayShape(['id' => "number", 'color' => "mixed", 'img' => "mixed", 'price' => "string"])]
        public function toArray($request): array {
            return [
                'id' => $this->id,
                'color' => $this->color,
                'img' => $this->img,
                'price' => number_format($this->price, 0, ',', ' '),
            ];
        }
    }
