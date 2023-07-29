<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'tags' => $this->tags ? explode(',', $this->tags) : [],
            'image' => $this->image,
            'type' => $this->type,
            'stock' => $this->stock,
            'short_details' => $this->short_details,
            'long_details' => $this->long_details,
            'status' => $this->status,
            'view_count' => $this->view_count,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
