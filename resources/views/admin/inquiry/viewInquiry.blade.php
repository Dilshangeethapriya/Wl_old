<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.5rem;
        }

        .card-body {
            padding: 20px;
        }

        .inquiry-subject{
            text-align:center;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            padding: 10px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        p {
            margin: 0 0 10px;
        }

        .badge {
            display: inline-block;
            padding: 15px 20px;
            color: #fff;
            background-color: #28a745;
            border-radius: 3px;
            font-size: 20px;
        }

        .badge.new {
        background-color: #007bff; /* Blue for 'New' */
     }

      .badge.in-progress {
        background-color: #ffc107; /* Yellow for 'In Progress' */
     }

      .badge.closed {
        background-color: #28a745; /* Green for 'Closed' */
      }

        .card-footer {
            background-color: #f7f7f7;
            padding: 15px;
            text-align: right;
        }

        .btn {
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 3px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Inquiry Details</h1>

        <div class="card">
            <div class="card-header">
                <h3>Inquiry No: {{$inquiry->ticketID}}</h3> 
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <p><strong>Name:</strong> {{$inquiry->name}}</p> 
                    </div>
                    <div class="col">
                        <p><strong>Email:</strong> {{$inquiry->email}}</p> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <p><strong>Phone:</strong> {{$inquiry->phone}}</p> 
                    </div>
                    <div class="col">
                        <p><strong>Created At:</strong> {{$inquiry->created_at}}</p> 
                        <p><strong>Updated At:</strong> {{$inquiry->updated_at}}</p>    
                    </div>
                </div>
                    <div class="row mb-3">
                    <div class="col">
                    <h3 class="inquiry-subject"> {{$inquiry->subject}}</h3>
                    </div>
                    </div>
                <div class="row mb-3">
                    <div class="col">
                        <p><strong>Message:</strong> {{$inquiry->ticketText}}</p> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                    <span class="badge 
                                @if($inquiry->ticketStatus == 'New') new 
                                @elseif($inquiry->ticketStatus == 'In Progress') in-progress 
                                @elseif($inquiry->ticketStatus == 'Closed') closed 
                                @endif">
                                {{$inquiry->ticketStatus}}
                            </span>
                    </div> 
                </div>
            </div>
            <div class="card-footer">
                
                <div class="row mb-3">
                <div class="col">
                        <!-- Status Update Form -->
                        <form method="POST" action="{{ route('admin.inquiry.updateStatus', $inquiry->ticketID) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="status">Change Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="New" {{ $inquiry->ticketStatus == 'New' ? 'selected' : '' }}>New</option>
                                    <option value="In Progress" {{ $inquiry->ticketStatus == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Closed" {{ $inquiry->ticketStatus == 'Closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </form>
                    </div>
                    <div class="col">
                        <!-- Delete Inquiry Form (Only shown if the inquiry is closed) -->
                        @if($inquiry->ticketStatus == 'Closed')
                        <form method="POST" action="{{ route('admin.inquiry.delete', $inquiry->ticketID) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Inquiry</button>
                        </form>
                        @endif
                    </div>
                    <div class="col">
                        <a href="{{ route('admin.inquiry.index') }}" class="btn">Back to Inquiries</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
