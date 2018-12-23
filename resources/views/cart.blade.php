@extends('layouts.app')
@section('content')
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>CART PAGE</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Cart page</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- shopping-cart-area start -->
<div class="cart-main-area ptb-100">
    <div class="container">
        <h3 class="page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Until Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#"><img src="assets/img/cart/cart-3.jpg" alt=""></a>
                                </td>
                                <td class="product-name"><a href="#">Dutchman's Breeches </a></td>
                                <td class="product-price-cart"><span class="amount">$260.00</span></td>
                                <td class="product-quantity">
                                    <div class="pro-dec-cart">
                                        <input class="cart-plus-minus-box" type="text" value="02" name="qtybutton">
                                    </div>
                                </td>
                                <td class="product-subtotal">$110.00</td>
                                <td class="product-remove">
                                    <a href="#"><i class="fa fa-pencil"></i></a>
                                    <a href="#"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#"><img src="assets/img/cart/cart-4.jpg" alt=""></a>
                                </td>
                                <td class="product-name"><a href="#">Flowers Bouquet Pink</a></td>
                                <td class="product-price-cart"><span class="amount">$150.00</span></td>
                                <td class="product-quantity">
                                    <div class="pro-dec-cart">
                                        <input class="cart-plus-minus-box" type="text" value="02" name="qtybutton">
                                    </div>
                                </td>
                                <td class="product-subtotal">$150.00</td>
                                <td class="product-remove">
                                    <a href="#"><i class="fa fa-pencil"></i></a>
                                    <a href="#"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#"><img src="assets/img/cart/cart-5.jpg" alt=""></a>
                                </td>
                                <td class="product-name"><a href="#">Evergreen Candytuft </a></td>
                                <td class="product-price-cart"><span class="amount">$170.00</span></td>
                                <td class="product-quantity">
                                    <div class="pro-dec-cart">
                                        <input class="cart-plus-minus-box" type="text" value="02" name="qtybutton">
                                    </div>
                                </td>
                                <td class="product-subtotal">$170.00</td>
                                <td class="product-remove">
                                    <a href="#"><i class="fa fa-pencil"></i></a>
                                    <a href="#"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="#">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <button>Update Shopping Cart</button>
                                    <a href="#">Clear Shopping Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>Enter your destination to get a shipping estimate.</p>
                                <div class="tax-select-wrapper">
                                    <div class="tax-select">
                                        <label>
                                            * Country
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * Region / State
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * Zip/Postal Code
                                        </label>
                                        <input type="text">
                                    </div>
                                    <button class="cart-btn-2" type="submit">Get A Quote</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                <form>
                                    <input type="text" required="" name="name">
                                    <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5>Total products <span>$260.00</span></h5>
                            <div class="total-shipping">
                                <h5>Total shipping</h5>
                                <ul>
                                    <li><input type="checkbox"> Standard <span>$20.00</span></li>
                                    <li><input type="checkbox"> Express <span>$30.00</span></li>
                                </ul>
                            </div>
                            <h4 class="grand-totall-title">Grand Total  <span>$260.00</span></h4>
                            <a href="#">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection