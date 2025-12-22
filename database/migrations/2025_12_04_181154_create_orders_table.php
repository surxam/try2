<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\OrderStatus;

return new class extends Migration
{
    /**
     * Crée la table des commandes
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Numéro de commande unique
            $table->string('order_number')->unique();

            // Relation avec l'utilisateur (client)
            $table->foreignId('user_id')
                ->constrained()
                ->restrictOnDelete();

            // Statut de la commande
            $table->string('status')->default(OrderStatus::PENDING->value);

            // Montants
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('shipping', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            /*
            |--------------------------------------------------------------------------
            | Paiement Stripe
            |--------------------------------------------------------------------------
            */

            // Identifiant de la session Checkout
            $table->string('stripe_checkout_session_id')->nullable();

            // Identifiant du PaymentIntent
            $table->string('stripe_payment_intent_id')->nullable();

            // Statut du paiement
            // unpaid, paid, refunded, partially_refunded
            $table->string('payment_status')->default('unpaid');

            // Méthode de paiement (card, paypal, apple_pay, etc.)
            $table->string('payment_method')->nullable();

            // Date du paiement
            $table->timestamp('paid_at')->nullable();

            // Remboursement
            $table->string('stripe_refund_id')->nullable();
            $table->decimal('refunded_amount', 10, 2)->default(0);
            $table->timestamp('refunded_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Informations de livraison
            |--------------------------------------------------------------------------
            */

            $table->string('shipping_name');
            $table->string('shipping_email');
            $table->string('shipping_phone');
            $table->text('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_postal_code');

            // Notes
            $table->text('customer_notes')->nullable();
            $table->text('admin_notes')->nullable();

            // Dates importantes
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */
            $table->index('order_number');
            $table->index('user_id');
            $table->index('status');
            $table->index('created_at');

            $table->index('stripe_checkout_session_id');
            $table->index('stripe_payment_intent_id');
            $table->index('payment_status');
        });
    }

    /**
     * Supprime la table orders
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};