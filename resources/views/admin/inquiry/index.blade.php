<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Inquiries</title>
   <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .admin-container {
            width: 80%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .inquiry-list {
            display: flex;
            flex-direction: column;
        }

        .list-header {
          display: flex;
            justify-content: space-between;
            padding: 12px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
          background-color:  #c5ffec;
        }

        .inquiry-item {
            display: flex;
            justify-content: space-between;
            padding: 12px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        .inquiry-item:hover {
            background-color: #f1f1f1;
        }

        .inquiry-item div {
            flex: 1;
            text-align: left;
            padding: 0 10px;
        }

        .inquiry-item div:nth-child(4) {
            text-align: right;
        }

        a {
           text-decoration: none;
          color:unset;
              }



        .badge.new {
        color: #007bff; /* Blue for 'New' */
     }

      .badge.in-progress {
       color: #ffc107; /* Yellow for 'In Progress' */
     }

      .badge.closed {
       color: #28a745; /* Green for 'Closed' */
      }

      .alert {
  padding: 20px;
  color: white;
  margin-bottom: 15px;
  margin-top: 15px;
 }


   .closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
   }


   .closebtn:hover {
  color: black;
   }

      .alert-success{
        background-color: #28a745;
      }
      
      .alert-danger{
        background-color: #dc143c;
      }

    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Customer Inquiries</h1>
        @if (session('success'))
        <div class="alert alert-success">
               <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                      {{ session('success') }}
              </div>
        <br>

    @endif

    @if (session('error'))
    <div class="alert alert-danger">
               <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
               {{ session('error') }}
              </div>
        <br>
        
    @endif
        <div class="inquiry-list">
        <div class="list-header" >
                <div><strong>Name</strong></div>
                <div><strong>Subject</strong></div>
                <div><strong>Date and Time</strong></div>
                <div><strong>Status</strong></div>
            </div>
            @foreach($inquiries as $inquiry)
            <a href="{{ route('admin.inquiry.viewInquiry', $inquiry->ticketID) }}">
            <div class="inquiry-item" >
                <div>{{ $inquiry->name }}</div>
                <div>{{ $inquiry->subject }}</div>
                <div>{{ $inquiry->created_at }}</div>
                <div><span class="badge 
                                @if($inquiry->ticketStatus == 'New') new 
                                @elseif($inquiry->ticketStatus == 'In Progress') in-progress 
                                @elseif($inquiry->ticketStatus == 'Closed') closed 
                                @endif">
                                {{$inquiry->ticketStatus}}
                            </span></div>
            </div>
            </a>
            
            @endforeach
        </div>
        {{$inquiries->links('vendor/pagination/simple-default')}}
    </div>

    
</body>
</html>
