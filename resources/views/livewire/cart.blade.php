 <section class="shop-cart spad" wire:poll.keep-alive-4s>
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="shop__cart__table">
                     <table>
                         @if (session('success'))
                             <div class="alert alert-success" role="alert">
                                 {{ session('success') }}
                             </div>
                         @elseif (session('error'))
                             <div class="alert alert-warning" role="alert">
                                 {{ session('error') }}
                             </div>
                         @endif
                         <thead>
                             <tr>
                                 <th>Product</th>
                                 <th>Price</th>
                                 <th>Quantity</th>
                                 <th>Total</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($cart as $product)
                                 @if ($userAuth == $product['user_id'])
                                     <tr>
                                         <td class="cart__product__item">
                                             <img src="{{ asset('storage/' . $product->products->image) }}"
                                                 width="100px" height="100px" alt="">
                                             <div class="cart__product__item__title">
                                                 <h6>{{ $product->products->name }}</h6>
                                                 <div class="rating">
                                                     @for ($i = 1; $i <= 5; $i++)
                                                         <span
                                                             class="bi bi-star-fill{{ $i <= $product->products->rate ? ' checked' : '' }}"></span>
                                                     @endfor
                                                 </div>
                                             </div>
                                         </td>
                                         <td class="cart__price" wire:model='price'>$ {{ $product->products->price }}
                                         </td>
                                         <td class="cart__quantity">
                                             <div class="pro-qty">
                                                 <span wire:click="decreaseQuantity({{ $product['id'] }})"
                                                     class="dec qtybtn">-</span>
                                                 <input type="text" wire:model='quantity'
                                                     value="{{ $product['quantity'] }}">
                                                 <span wire:click="increaseQuantity({{ $product['id'] }})"
                                                     class="inc qtybtn">+</span>
                                             </div>
                                         </td>
                                         <td class="cart__total">
                                             $ {{ $product->quantity * $product->products->price }}
                                         </td>
                                         <td class="cart__close"><span wire:click.prevent='delete({{ $product->id }})'
                                                 class="icon_close"></span></td>
                                     </tr>
                                     {{-- <tr>
                                         <td colspan="5">No Product Yet</td>
                                     </tr> --}}
                                 @endif
                             @endforeach

                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-lg-6 col-md-6 col-sm-6">
                 <div class="cart__btn">
                     <a href="#">Continue Shopping</a>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6">
                 <div class="cart__btn update__btn">
                     <a href="#"><span class="icon_loading"></span> Update cart</a>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-lg-6">
                 <div class="discount__content">
                     <h6>Discount codes</h6>
                     <form action="#">
                         <input type="text" placeholder="Enter your coupon code">
                         <button type="submit" class="site-btn">Apply</button>
                     </form>
                 </div>
             </div>
             <div class="col-lg-4 offset-lg-2">
                 <div class="cart__total__procced">
                     <h6>Cart total</h6>
                     <ul>
                         <li>Subtotal <span>$ {{ $totalPrice }}</span></li>
                         <li>Total <span>$ {{ $totalPrice }}</span></li>
                     </ul>
                     <a href="#" class="primary-btn">Proceed to checkout</a>
                 </div>
             </div>
         </div>
     </div>
 </section>
