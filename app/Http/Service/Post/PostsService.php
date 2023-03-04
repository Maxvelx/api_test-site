<?php

namespace App\Http\Service\Post;

use App\Models\Post\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostsService
{
    private mixed $imageIds = null;

    public function checkAndUnset($data)
    {
        if (!empty($data['image'])) {
            $this->imageIds = $data['image'];
            unset($data['image']);
        }

        return $data;
    }

    public function store($data): void
    {
        try {

            DB::beginTransaction();

            $data = $this->checkAndUnset($data);

            if ($this->imageIds) {

                $path = $this->imageIds->hashName();

                Image::make($this->imageIds)->resize(900, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/post/image/'.$path));

                $data['path_image'] = 'post/image/'.$path;
            }

            $post = Post::create($data);

            if (!empty($this->tagsIds)) {
                $post->tags()->attach($this->tagsIds);
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $post): void
    {
        try {

            DB::beginTransaction();

            $data = $this->checkAndUnset($data);

            if ($this->imageIds) {

                $path = $this->imageIds->hashName();

                Storage::disk('public')->delete('/'.$post->path_image);
                Image::make($this->imageIds)->resize(900, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/post/image/'.$path));

                $data['path_image'] = 'post/image/'.$path;
            }

            $post->update($data);

            if (!empty($this->tagsIds)) {$post->tags()->sync($this->tagsIds);}

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }
    }
}
