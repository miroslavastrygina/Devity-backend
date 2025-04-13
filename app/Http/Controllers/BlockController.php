<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockRequest;
use Exception;
use App\Services\BlockService;

class BlockController extends Controller
{
    public function __construct(private readonly BlockService $blockService) {}

    public function index()
    {
        try {
            $blocks = $this->blockService->index();
            return response()->json([
                "success" => true,
                "data" => $blocks
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function show(int $id)
    {
        try {
            $block = $this->blockService->show($id);
            return response()->json([
                "success" => true,
                "data" => $block
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function create(BlockRequest $block)
    {
        try {
            $newBlock = $this->blockService->create($block);
            return response()->json([
                "success" => true,
                "data" => $newBlock
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function update(BlockRequest $block, int $id)
    {
        try {
            $updatedBlock = $this->blockService->update($id, $block);
            return response()->json([
                "success" => true,
                "data" => $updatedBlock
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->blockService->delete($id);
            return response()->json([
                "success" => true,
                "msg" => "Блок удален"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }
}
