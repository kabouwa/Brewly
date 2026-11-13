import { Bean, Coffee, Heart } from "lucide-react";

// Keep homepage copy and imagery together so the sections stay easy to update.
export const homeImages = {
    hero: 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=1400&q=85',
    about: 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1200&q=85',
};

export const featuredDrinks = [
    {
        name: 'Espresso',
        category: 'THE CLASSIC',
        description: 'Small cup. Full character. For the moments that call for something bold.',
        image: 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=800&q=85',
        imageAlt: 'A small cup of espresso on a saucer',
    },
    {
        name: 'Caffè Latte',
        category: 'SOMETHING SOFT',
        description: 'Espresso meets steamed milk for a smooth, comforting coffee break.',
        image: 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=85',
        imageAlt: 'A cup of coffee with milk and latte art',
    },
    {
        name: 'Iced Coffee',
        category: 'KEEP IT COOL',
        description: 'A refreshing way to enjoy your coffee, one unhurried sip at a time.',
        image: 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=800&q=85',
        imageAlt: 'A glass of iced coffee',
    },
];

export const moments = [
    {
        Icon: Bean,
        title: 'Find your flavor',
        description: 'Bold and simple or smooth and mellow. There’s more than one way to enjoy a coffee.',
    },
    {
        Icon: Coffee,
        title: 'Make it a ritual',
        description: 'A familiar favorite can turn a few spare minutes into the best part of your day.',
    },
    {
        Icon: Heart,
        title: 'Enjoy the moment',
        description: 'Bring a good conversation, a good book, or simply yourself. The pause is yours.',
    },
];
