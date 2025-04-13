<?php

namespace App\Services;

use App\Http\Requests\BlockRequest;
use App\Models\Block;

class BlockService
{
    public function index()
    {
        return Block::all();
    }

    public function show(int $id)
    {
        $block = Block::find($id);

        return $block;
    }

    public function create(BlockRequest $block)
    {
        $blockData = $block->validated();
        $newBlock = Block::create($blockData);

        return $newBlock;
    }

    public function update(int $id, BlockRequest $block)
    {
        $blockData = $block->validated();
        $updateBlock = $this->show($id);
        $updateBlock->update($blockData);
        $updateBlock->save();

        return $updateBlock;
    }

    public function delete(int $id)
    {
        $deletedBlock = $this->show($id);
        $deletedBlock->delete();
    }
}