<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    public function fetchAllTasks() {
        $tasks = Task::where('user_id', Auth::user()->id)->get();
        return view('dashboard', compact('tasks'));
    }

    public function showCreateForm() {
        return view('create');
    }

    public function create(Request $request) {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'due_date' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);
        }

        $task = Task::create([
            'image' => 'images/' . $imageName,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'user_id' => Auth::id(), // 自动获取当前登录用户的 ID
        ]);

        return redirect()->route('dashboard')->with('success', 'Task created successfully');
    }

    public function doneTask(Request $request, $id) {
        $task = Task::findOrFail($id);

        $task->isCompleted  = true;
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task marked as done');
    }

    public function resetTask(Request $request, $id) {
        $task = Task::findOrFail($id);

        $task->isCompleted = false;
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task marked as undone');
    }

    public function viewTask($id) {
        $task = Task::findOrFail($id);
        return view('view', compact('task'));
    }

    public function showEditForm($id) {
        $task = Task::findOrFail($id);
        return view('edit', compact('task'));
    }

    public function edit(Request $request, $id) {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'due_date' => 'required|date',
        ]);

        $task = Task::findOrFail($id);

        // 处理图片上传
        if ($request->hasFile('image')) {
            // 删除旧的图片文件
            if ($request->image && file_exists(public_path('assets/' . $task->image))) {
                unlink(public_path('assets/' . $task->image));
            }

            // 上传新的图片
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/images'), $imageName);
            $task->image = 'images/' . $imageName;
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task updated successfully');
    }

    public function destroy($id) {
        $task = Task::findOrFail($id);
        
        $imagePath = public_path('assets/' . $task->image);

        if (file_exists($imagePath)) {
            // 删除图片文件
            unlink($imagePath);
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task deleted successfully');
    }
}