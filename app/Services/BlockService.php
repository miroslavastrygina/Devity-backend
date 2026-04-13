<?php

namespace App\Services;

use App\Http\Requests\BlockRequest;
use App\Models\Block;

class BlockService
{
    public function index()
    {
        return Block::with(['course', 'lessons'])->get();
    }

    public function show(int $id)
    {
        $block = Block::with(['course', 'lessons'])->find($id);

        return $block;
    }

    public function create(BlockRequest $block)
    {
        $blockData = $block->validated();
        $newBlock = Block::create($blockData['block']);

        return $newBlock;
    }

    public function update(int $id, BlockRequest $block)
    {
        $blockData = $block->validated();
        $updateBlock = $this->show($id);
        $updateBlock->update($blockData['block']);
        $updateBlock->save();

        return $updateBlock;
    }

    public function delete(int $id)
    {
        $deletedBlock = $this->show($id);
        $deletedBlock->delete();
    }
}
