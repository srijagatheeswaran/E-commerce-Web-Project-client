@extends('layout')
@section('title', 'Dash Board')

@section('content')

<div class="dashboard">

    <header>
        <h1>Dashboard</h1>
        <div>
            <a class="btn btn-danger" href="{{url("logout")}}">Logout</a>
        </div>
    </header>

</div>
<div class="slider">
    <a>
        <i class="bi bi-house"></i>
        <p>Home</p>
    </a>
    <a>
        <i class="bi bi-person-circle"></i>
        <p>Profile</p>
    </a>
    <a>
        <i class="bi bi-bag-heart"></i>
        <p>Like</p>
    </a>
    <a>
        <i class="bi bi-cart-fill"></i>
        <p>Cart</p>
    </a>
    <a>
        <i class="bi bi-bag-fill"></i>

        <p>Orders</p>
    </a>


</div>


@endsection

@section('script')

@endsection