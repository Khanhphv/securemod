<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('new.style')
    <style>
        #notice {
            display: none;
        }
    </style>
</head>
<body>
@extends('new.master-layout')
@section('content')
    <div class="tab-content mobile" style="display: flex">
        <div class="row bg-white">
            <div class="col s12 m12">
                <h5 class="row">
                    Update your Subscription Preferences
                </h5>
                <h6 class="row">
                    Email: <b>vietkhanh1310@gmail.com</b>
                </h6>
                <form action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="put" />
                    <table class="striped display compact">
                        <thead>
                        <tr>
                            <th>Subcribe</th>
                            <th>Unsubcribe</th>
                            <th>Subscription Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <p>
                                    <label>
                                        <input class="with-gap" type="radio" name="subscribe" checked  value="1" />
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                            <td>
                                <label>
                                    <input class="with-gap" type="radio" name="subscribe"  value="0" />
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <b>Site Notifications:</b>
                                <br>
                                Notification, Event,....
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <br>
                    <button class="waves-effect waves-light btn" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
</body>
</html>
