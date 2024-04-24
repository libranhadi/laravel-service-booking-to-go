@extends('layouts.customer-layout')
@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h1>Customers</h1>
        </div>
        <div>
            <a href="{{ route('customers.create') }}" class="btn btn-success">Create</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Customer List
        </div>

        @if(session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Email</th>
                            <th scope="col">Kewarganegaraan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($customers) <= 0)
                            <tr>
                                <td colspan="6">
                                    No Customer Data 
                                </td>
                            </tr>
                        @endif
                        @foreach ($customers as $index => $customer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $customer->cst_name }}</td>
                                <td>{{ $customer->cst_dob }}</td>
                                <td>{{ $customer->cst_phoneNum }}</td>
                                <td>{{ $customer->cst_email }}</td>
                                <td>{{ $customer->nationality->label ?? 'N/A' }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('customers.edit', ['id' => $customer->cst_id]) }}" class="btn btn-primary" style="margin-right: 10px;">Edit</a>
                                        <form action="{{ route('customers.destroy', ['id' => $customer->cst_id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</a>
                                        </form>
                                    </div>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <nav>
            {!! $customers->appends($_GET)->links() !!}
        </nav>
    </div>
@endsection