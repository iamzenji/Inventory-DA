<?php
namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\TryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TryController extends Controller {
	// set index page view
	public function index() {
		return view('inventory/try');
	}
	// handle fetch all eamployees ajax request
	public function fetchAll() {
		$emps = TryModel::all();
		$output = '';
	
		if ($emps->count() > 0) {
			foreach ($emps as $emp) {
				$output .= '<tr>
					<td>' . $emp->id . '</td>
					<td><img src="storage/images/' . $emp->avatar . '" width="50" class="img-thumbnail rounded-circle"></td>
					<td>' . $emp->first_name . ' ' . $emp->last_name . '</td>
					<td>' . $emp->email . '</td>
					<td>' . $emp->post . '</td>
					<td>' . $emp->phone . '</td>
					<td>
						<a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">
							<i class="bi-pencil-square h4"></i>
						</a>
						<a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon">
							<i class="bi-trash h4"></i>
						</a>
					</td>
				</tr>';
			}
		} else {
			$output .= '<tr>
				<td colspan="7" class="text-center text-secondary">No record present in the database!</td>
			</tr>';
		}
	
		echo $output;
	}
	public function store(Request $request) {
		$file = $request->file('avatar');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);
		$empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'phone' => $request->phone, 'post' => $request->post, 'avatar' => $fileName];
		TryModel::create($empData);
		return response()->json([
			'status' => 200,
		]);
	}
	// handle edit an employee ajax request
	public function edit(Request $request) {
		$id = $request->id;
		$emp = TryModel::find($id);
		return response()->json($emp);
	}
	// handle update an employee ajax request
	public function update(Request $request) {
		$fileName = '';
		$emp = TryModel::find($request->emp_id);
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($emp->avatar) {
				Storage::delete('public/images/' . $emp->avatar);
			}
		} else {
			$fileName = $request->emp_avatar;
		}
		$empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'phone' => $request->phone, 'post' => $request->post, 'avatar' => $fileName];
		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}
	// handle delete an employee ajax request
	public function delete(Request $request) {
		$id = $request->id;
		$emp = TryModel::find($id);

		if ($emp) {
			if ($emp->avatar && Storage::exists('public/images/' . $emp->avatar)) {
				Storage::delete('public/images/' . $emp->avatar);
			}
			$emp->delete();
			return response()->json(['status' => 200, 'message' => 'Employee deleted successfully']);
		} else {
			return response()->json(['status' => 404, 'message' => 'Employee not found']);
		}
	}

}