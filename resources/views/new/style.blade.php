<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="/css/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<link rel="stylesheet" type="text/css" href="/css/reset.css">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/responsive2.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    #selectbox-games{
        width: 200px;
    }
    .pagination li {
        height: auto;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #ee6e73;
        border-color: #ee6e73 ;
    }
    .bg-white{
        background: #fff;
        padding: 0 15px;
        padding-bottom: 2em;
        border-radius: 10px;
        min-width: 100%;
        height: fit-content;
        min-height: 50vh;
    }
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter {
        text-align: left;
    }
    .menu .dropdown-content.select-dropdown {
        width: max-content!important;
    }
    h1 {
        font-size: 2.5em;
        font-weight: 700;
    }
    .footer {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: center;
        padding: 40px 0;
        width: 100%;
        background: white;
        margin-top: 20px;
        border-left: 1px solid #efefef;
        padding: 40px calc(10%);
    }

    .footer>div {
        display: flex;
        flex-direction: column;
        flex: 1
    }
    .footer h5 {
        margin-top: 0;
    }
    @media only screen and (max-width: 600px) {
        .footer {
            padding: 40px calc(5%);
        }
        .footer>div{
            display: flex;
            flex-wrap: wrap;
            min-width: 80%;
            margin-bottom: 20px;
        }

        .footer>div:last-child{
            margin-bottom: 0px
        }
    }
    .btn-quick-recharge {
        width: 80%;
        background: unset;
        padding: 7px;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        border-radius: 20px;
        margin-bottom: 10px;
        box-shadow: 1px 2px;
    }
    .btn-quick-recharge:focus {
        background: unset;
    }
    .btn-quick-recharge:active {
        transform: translateY(2px);
        transition: all ease-in-out 0.01s;
        box-shadow: unset;
    }
    @media only screen and (max-width: 600px) {
        .menu {
            position: fixed;
            top: 0;
            z-index: 1000000;
        }
        .main {
            padding-top: 70px;
        }
        .container {
            height: 100% !important;
            overflow: hidden;
        }
        .content-view {
            z-index: 1;
        }
    }
    body {
        background: #FFF;
    }
</style>
