@extends('layouts.nav-hidden-layout', ['title' => 'Platba'])


@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/global-css/labeled-input.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/payment/content.css') }}">
@stop


@section('content')
<main>
    <form class="payment-details" name="payment-details">
        <section class="payment-progress">
            <div class="circle filled" data-content="Shipping">1.</div>
            <div class="bar"></div>
            <div class="circle" data-content="Detaily">2.</div>
            <div class="bar"></div>
            <div class="circle" data-content="Platba">3.</div>
            <div class="bar"></div>
            <div class="circle" data-content="">4.</div>
        </section>

        <section class="form-fields" id="step-1">
            <div class="option">
                <input type="radio" name="shipping_method" id="shipping_1">
                <img src="{{ asset('images/payment/packeta.png') }}" alt="shipping-method">
                <p>Packeta s.r.o.</p>
                <p>2.99€</p>
            </div>
            <div class="option">
                <input type="radio" name="shipping_method" id="shipping_2">
                <img src="{{ asset('images/payment/packeta.png') }}" alt="shipping-method">
                <p>Packeta s.r.o.</p>
                <p>2.99€</p>
            </div>
            <div class="option">
                <input type="radio" name="shipping_method" id="shipping_3">
                <img src="{{ asset('images/payment/packeta.png') }}" alt="shipping-method">
                <p>Packeta s.r.o.</p>
                <p>2.99€</p>
            </div>
            <div class="option">
                <input type="radio" name="shipping_method" id="shipping_4">
                <img src="{{ asset('images/payment/packeta.png') }}" alt="shipping-method">
                <p>Packeta s.r.o.</p>
                <p>2.99€</p>
            </div>

            <div style="display: flex; justify-content: space-between;">
                <a style="width: auto; padding: .75rem 1.5rem;" class="clickable-button low-prio" href="{{ route('shopping-cart') }}">
                    <i style="padding-right: 5px; font-size: 1.2rem; transform: translateY(2.5px);" class="fa-solid fa-left-long"></i>Do košíka
                </a>
                <x-clickable-button :onclick="'Cashier.nextPrevStep(true)'" disabled :styles="'padding: .75rem 1.5rem; width: auto;'">
                    Pokračovať<i style="padding-left: 5px; font-size: 1.2rem; transform: translateY(2.5px);" class="fa-solid fa-right-long"></i>
                </x-clickable-button>
            </div>
        </section>

        <section style="display: none;" id="step-2">
            <div style="max-width: clamp(270px, 100%, 768px);"  class="form-fields">
                <div style="display: flex; justify-content: space-between; gap: 2rem;">
                    <div style="flex: 50%" class="labeled-input elevated">
                        <input name="first_name" id="first-name" required>
                        <label for="first-name">Meno</label>
                    </div>

                    <div style="flex: 50%" class="labeled-input elevated">
                        <input name="last_name" id="last-name" required>
                        <label for="last-ame">Priezvisko</label>
                    </div>
                </div>

                <div class="labeled-input elevated">
                    <input type="email" id="email" name="email" required>
                    <label for="email">E-Mail</label>
                </div>

                <div class="labeled-input elevated">
                    <input type="tel" id="phone-number" name="phone_number" required maxlength="16">
                    <label for="phone-number">Telefónne číslo</label>
                </div>

                <div class="labeled-input elevated">
                    <input id="address" name="address" required>
                    <label for="address">Adresa</label>
                </div>

                <div style="display: flex; justify-content: space-between; gap: 2rem;">
                    <div style="flex: 60%" class="labeled-input elevated">
                        <input id="city" name="city" required>
                        <label for="city">Mesto</label>
                    </div>

                    <div class="labeled-input elevated">
                        <input id="zip-code" name="zip_code" maxlength="5" required>
                        <label for="zip-code">PSČ</label>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 2rem;">
                <x-clickable-button :onclick="'Cashier.nextPrevStep(false)'" :styles="'width: auto; padding: .75rem 1.5rem;'" lowPrio>
                    <i style="padding-right: 5px; font-size: 1.2rem; transform: translateY(2.5px);" class="fa-solid fa-left-long"></i>Shipping
                </x-clickable-button>

                <x-clickable-button disabled  :onclick="'Cashier.nextPrevStep(true)'" :type="'button'" :styles="'padding: .75rem 1.5rem; width: auto;'" >
                    Pokračovať<i style="padding-left: 5px; font-size: 1.2rem; transform: translateY(2.5px);" class="fa-solid fa-right-long"></i>
                </x-clickable-button>
            </div>
        </section>

        <section style="display: none;" class="form-fields" id="step-3">
            <div class="option">
                <input type="radio" name="payment-method" id="payment-1">
                <img src="{{ asset('images/payment/paypal.png') }}" alt="payment-method">
                <p>PayPal</p>
                <p>1.99€</p>
            </div>
            <div class="option">
                <input type="radio" name="payment-method" id="payment-2">
                <img src="{{ asset('images/payment/mastercard.png') }}" alt="payment-method">
                <p>MasterCard</p>
                <p>0.00€</p>
            </div>
            <div class="option">
                <input type="radio" name="payment-method" id="payment-3">
                <img src="{{ asset('images/payment/bank_transfer.png') }}" alt="payment-method">
                <p>Bankový prevod</p>
                <p>0.00€</p>
            </div>

            <div style="display: flex; justify-content: space-between; padding: 2rem;">
                <x-clickable-button :onclick="'Cashier.nextPrevStep(false)'" :styles="'width: auto; padding: .75rem 1.5rem;'" lowPrio>
                    <i style="padding-right: 5px; font-size: 1.2rem; transform: translateY(2.5px);" class="fa-solid fa-left-long"></i>Detaily
                </x-clickable-button>

                <x-clickable-button disabled :onclick="'Cashier.makePayment()'" :styles="'padding: .75rem 1.5rem; width: auto;'">
                    <a href="https://youtu.be/dQw4w9WgXcQ?si=tn8HJUtjdOeCRx6w" target="_blank">
                        Zaplatiť<i style="padding-left: 5px; font-size: 1.2rem; transform: translateY(2.5px);" class="fa-solid fa-cash-register"></i>
                    </a>
                </x-clickable-button>
            </div>
        </section>

        <section class="form-fields" style="display: none; min-height: 25rem;" id="step-4">
            <p style="font-size: 3rem; justify-self: center; text-align: center;">DÍK ZA TVOJE LÓVE</p>
            <i style="font-size: 5rem; justify-self: center; color: green" class="fa-solid fa-circle-check"></i>

            <a class="clickable-button" style="padding: 1rem 2rem; width: auto; max-height: 5rem; font-size: 2rem; justify-self: center;" href="{{ route('home') }}">
                Ukončiť nákup
            </a>
        </section>
    </form>
</main>
@stop


@section('scripts')
<script src="{{ asset('js/payment/index.js') }}"></script>
@stop
