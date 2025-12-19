@extends('layouts.boutique')


@section('content')



<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- En-tête -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Mon Panier</h1>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Section des articles -->
            <div class="px-6 py-4">
                @if ($cart->items->isEmpty())
                    <!-- Panier vide -->
                    <div class="text-center py-12">
                        <i class="fas fa-shopping-cart text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500 text-lg">Votre panier est vide</p>
                        <a href="{{route('home')}}" class="inline-block mt-4 px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Découvrir nos produits
                        </a>
                    </div>
                @else
                    <!-- Liste des articles -->
                    <ul class="divide-y divide-gray-200 mt-4">
                        @foreach ($cart->items as $item)
                            <li class="flex items-center justify-between py-4">
                                <!-- Image du produit -->
                                <div class="flex-shrink-0">
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="h-20 w-20 object-cover rounded-md border border-gray-200" >
                                </div>

                                <!-- Détails du produit -->
                                <div class="flex-1 ml-4">
                                    <div class="flex justify-between">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-lg font-semibold text-gray-900">{{ $item->formatted_price }}</p>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">{{ $item->product->category->name  }}</p>

                                    <div class="flex justify-between items-center mt-2 text-sm text-gray-600">
                                        <!-- Quantité -->
                                        <div class="flex items-center space-x-2">
                                            <span class="font-medium">Quantité:</span>
                                            <form method="POST" action="{{ route('cart.update', $item->id) }}" class="flex items-center">
                                                @method('PUT')
                                                @csrf
                                                <select name="quantity" class="border rounded px-2 py-1" onchange="this.form.submit()">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}" @if ($i == $item->quantity) selected @endif>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </form>
                                        </div>

                                        <!-- Bouton "Supprimer" -->
                                        <form method="post" action="{{route('cart.remove', $item->id)}}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-red-600 hover:text-red-500">
                                                <i class="fas fa-trash mr-1"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Total du panier -->
            @if (!$cart->items->isEmpty())
                <div class="border-t border-gray-200 px-6 py-4">
                    <div class="space-y-3">
                        <div class="flex justify-between text-base text-gray-600">
                            <p>Sous-total</p>
                            <p>{{ $cart->formatted_subtotal }} €</p>
                        </div>
                        <div class="flex justify-between text-base text-gray-600">
                            <p>Frais de port estimés</p>
                            <p>{{ number_format($cart->shipping, 2) }} €</p>
                        </div>
                       
                    </div>

                    <div class="border-t border-gray-200 mt-4 pt-4">
                        <div class="flex justify-between text-lg font-bold text-gray-900">
                            <p>Total TTC</p>
                            <p>{{ $cart->formatted_subtotal }} €</p>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Les frais de port et les taxes sont calculés à la caisse.</p>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 space-y-4">

                        <!-- Boutons d'action -->
                        <div class="flex space-x-4">
                            <form method="post" action="{{route('cart.clear',$item)}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="flex-1 text-center px-6 py-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                    Vider Panier
                                </button>
                            </form> 
                            <a href="{{route('checkout.index')}}" class="flex-1 text-center px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Passer la commande
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Informations complémentaires -->
        @if (!$cart->items->isEmpty())
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-4 rounded-lg shadow-sm border">
                    <div class="flex items-center">
                        <i class="fas fa-shipping-fast text-indigo-600 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-semibold">Livraison gratuite</h3>
                            <p class="text-sm text-gray-500">À partir de 50€ d'achat</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border">
                    <div class="flex items-center">
                        <i class="fas fa-undo-alt text-indigo-600 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-semibold">Retours gratuits</h3>
                            <p class="text-sm text-gray-500">Sous 30 jours</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border">
                    <div class="flex items-center">
                        <i class="fas fa-lock text-indigo-600 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-semibold">Paiement sécurisé</h3>
                            <p class="text-sm text-gray-500">Cryptage SSL</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>

</html>



@endsection






















