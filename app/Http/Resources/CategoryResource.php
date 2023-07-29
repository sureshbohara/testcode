<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return[
         'id' => $this->id,
         'name' => $this->name,
         'parent_id' => $this->parent_id,
         'slug' => $this->slug,
         'image' => $this->image,
         'type' => $this->type,
         'description' => $this->description,
         'order_level' => $this->order_level,
         'status' => $this->status,
         'meta_title' => $this->meta_title,
         'meta_description' => $this->meta_description,
     ];
    }
}
