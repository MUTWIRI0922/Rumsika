
@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Pending KYC Requests</h2>
    <table class="table">
        <thead>
            <tr>
                <th>User name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
                @forelse ($kycRequests ?? [] as $request)
                <tr>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->user->email }}</td>
                    <td>{{ $request->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm">View</a>
                        <form method="POST" action="{{ route('admin.kyc.request.approve', $request->id) }}">
                            @csrf
                            @method('PUT')

                            <button name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                            <button name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Coming soon.....</td>
                </tr>
                @endforelse
        </tbody>
    </table>
</div>
@endsection

