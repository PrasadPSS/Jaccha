import { Head, Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useState } from 'react';
import { asset } from '@/Helpers/asset';

export default function ProductSearch({ cart }) {
    let cart_items = [];
    cart.cart_items.forEach(element => {
        cart_items.push({id: element.id, name: element.product.name , description: element.product.description, price: element.product.price, quantity: 1});
    });
    console.log(cart.cart_items, cart_items);
    const [cartItems, setCartItems] = useState(cart_items);

    // Calculate total price
    const calculateTotal = () => {
        return cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
    };

    // Increase item quantity
    const increaseQuantity = (id) => {
        setCartItems(cartItems.map(item => item.id === id ? { ...item, quantity: item.quantity + 1 } : item));
    };

    // Decrease item quantity
    const decreaseQuantity = (id) => {
        setCartItems(cartItems.map(item =>
            item.id === id && item.quantity > 1 ? { ...item, quantity: item.quantity - 1 } : item
        ));
    };

    // Remove item from cart
    const removeItem = (id) => {
        setCartItems(cartItems.filter(item => item.id !== id));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <div className="container mx-auto p-6">
                                <h1 className="text-2xl font-bold mb-4">Shopping Cart</h1>
                                <div className="bg-white shadow-md rounded-lg p-4">
                                    {cartItems.map(item => (
                                        <div key={item.id} className="flex items-center justify-between border-b py-4">
                                            <div>
                                                <h2 className="text-lg font-medium">{item.name}</h2>
                                                <p className="text-gray-600 text-sm">{item.description}</p>
                                                <p className="text-gray-800 font-semibold">Price: ${item.price}</p>
                                            </div>
                                            <div className="flex items-center">
                                                <button
                                                    onClick={() => decreaseQuantity(item.id)}
                                                    className="px-3 py-1 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                                                >
                                                    -
                                                </button>
                                                <span className="mx-3">{item.quantity}</span>
                                                <button
                                                    onClick={() => increaseQuantity(item.id)}
                                                    className="px-3 py-1 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                                                >
                                                    +
                                                </button>
                                            </div>
                                            <button
                                                onClick={() => removeItem(item.id)}
                                                className="text-red-500 hover:text-red-600"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    ))}
                                </div>
                                <div className="mt-4 text-right">
                                    <h2 className="text-xl font-bold">Total: ${calculateTotal()}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
