<!DOCTYPE html>
<html>
<head>
    <title>User Credential</title>
    <style type="text/css">
        table td{
            padding: 5px 0px;
            font-family: Verdana;
        }
    </style>
</head>
<body>

<table>

    <tr>
        <td>
            Dear <strong>{{ $user->name }}</strong>,
        </td>
    </tr>
    <tr>
        <td>
            Here goes your Account Credential:
        </td>
    </tr>
    <tr>
        <td>
            URL: {{ url('/login')}}<br>
            Username: {{ $user->email }}<br>
            Password: {{ $user->password }}
        </td>
    </tr>
    <tr>
        <td>
            Please note that, all the activities done from your account are logged, and will be marked as your activity and responsibility. Do not share your Account's Credential with others.
        </td>
    </tr>
    
</table>

</body>
</html>