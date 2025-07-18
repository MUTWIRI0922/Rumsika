
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pending KYC Requests</h2>
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>ID Photo</th>
                <th>Selfie</th>
                <th>Score</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
                <tr>
                    <td>name</td>
                   
                    <td>2</td>
                    <td>5</td>
                    <td>
                        <form method="POST" action="">
                            @csrf
                            @method('PUT')
                            <button name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                            <button name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
          
        </tbody>
    </table>
</div>
@endsection

