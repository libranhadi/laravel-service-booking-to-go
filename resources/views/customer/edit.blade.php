@extends('layouts.customer-layout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customer List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Page</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            Edit Customer
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
            @endif
            <form action="{{ route('customers.update', ['id' => $customer->cst_id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="cst_name">Name <sup style="color:red">*</sup></label>
                    <input type="text" class="form-control" id="cst_name" name="cst_name" placeholder="masukan nama" value="{{ old('cst_name', $customer->cst_name) }}" required>
                    @error("cst_name")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="cst_phoneNum">Phone Number <sup style="color:red">*</sup></label>
                    <input type="tel" class="form-control" id="cst_phoneNum" name="cst_phoneNum" placeholder="masukan nomor telepon" value="{{ old('cst_phoneNum', $customer->cst_phoneNum) }}" required>
                    @error("cst_phoneNum")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="cst_email">Email<sup style="color:red">*</sup></label>
                    <input type="email" class="form-control" id="cst_email" name="cst_email" placeholder="masukan email" value="{{ old('cst_email', $customer->cst_email) }}" required>
                    @error("cst_phoneNum")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="cst_dob">Date Of Birth <sup style="color:red">*</sup></label>
                    <input type="date" class="form-control" id="cst_dob" name="cst_dob" value="{{ old('cst_dob', $customer->cst_dob) }}" required>
                    @error("cst_dob")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="nationality_id">Nationality <sup style="color:red">*</sup></label>
                    <select class="form-control" id="nationality_id" name="nationality_id" required>
                        <option value="">Pilih kewarganegaraan </option>
                        @foreach ($nationalities as $nationality)
                            <option value="{{ $nationality->nationality_id }}" {{ $nationality->nationality_id == old('nationality_id', $customer->nationality_id) ? 'selected' : '' }}>{{ $nationality->nationality_name }}</option>
                        @endforeach
                    </select>
                    @error("nationality_id")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" id="addFamily">Tambah Keluarga</a>
                </div>
                <table class="table family-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Hubungan</th>
                            <th>Tanggal Lahir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer->familyLists as $index => $family)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="family_lists[{{ $index }}][fl_name]" placeholder="Enter name" value="{{ old('family_lists.'.$family->fl_id.'.fl_name', $family->fl_name) }}" required>
                                    @error("family_lists.$family->id.fl_name")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="family_lists[{{ $index }}][fl_relation]" placeholder="Enter relationship" value="{{ old('family_lists.'.$family->fl_id.'.fl_relation', $family->fl_relation) }}" required>
                                    @error("family_lists.$family->id.fl_relation")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="family_lists[{{ $index }}][fl_dob]" value="{{ old('family_lists.'.$family->fl_id.'.fl_dob', $family->fl_dob) }}" required>
                                    @error("family_lists.$family->id.fl_dob")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger remove-row">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-success mt-3">Save</button>
            </form>
        </div>

        </div>
    </div>
@endsection

@section("scripts")
<script>
    $(document).ready(function () {
        $('#addFamily').click(function (e) {
            e.preventDefault();
            var rowCount = $('.family-table tbody tr').length;
            var newRow = '<tr>' +
                '<td><input type="text" class="form-control" name="family_lists[' + rowCount + '][fl_name]" placeholder="masukan nama" required></td>' +
                '<td><input type="text" class="form-control" name="family_lists[' + rowCount + '][fl_relation]" placeholder="masukan hubungan keluarga" required></td>' +
                '<td><input type="date" class="form-control" name="family_lists[' + rowCount + '][fl_dob]"></td>' +
                '<td><button type="button" class="btn btn-danger remove-row" required>Hapus</button></td>' +
                '</tr>';
            $('.family-table tbody').append(newRow);
        });

        $(document).on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
        });
    });
</script>
@endsection