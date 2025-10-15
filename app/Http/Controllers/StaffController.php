<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function response($status, $message, $data) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }

    // GET /api/staff - Get all staff
    public function index() {
        $staff = Staff::query()->get();
        return $this->response(200, "Staff retrieved successfully", $staff);
    }

    // GET /api/staff/{id} - Get single staff
    public function show($id) {
        $staff = Staff::find($id);
        if ($staff) {
            return $this->response(200, "Staff found", $staff);
        } else {
            return $this->response(404, "Staff not found", "");
        }
    }

    // POST /api/staff - Create staff
    public function store(Request $req) {
        $data = $req->validate([
            'staff_name' => 'required|string',
            'skill' => 'required|string',
            'status' => 'required|string|in:available,unavailable'
        ]);

        $staff = Staff::create($data);
        return $this->response(201, "Staff created successfully", $staff);
    }

    // PUT /api/staff/{id} - Update staff
    public function update(Request $req, $id) {
        $staff = Staff::find($id);
        if (!$staff) {
            return $this->response(404, "Staff not found", "");
        }

        $data = $req->validate([
            'staff_name' => 'required|string',
            'skill' => 'required|string',
            'status' => 'required|string|in:available,unavailable'
        ]);

        $staff->update($data);
        return $this->response(200, "Staff updated successfully", $staff);
    }

    // DELETE /api/staff/{id} - Delete staff
    public function destroy($id) {
        $staff = Staff::find($id);
        if (!$staff) {
            return $this->response(404, "Staff not found", "");
        }

        $staff->delete();
        return $this->response(200, "Staff deleted successfully", "");
    }
}