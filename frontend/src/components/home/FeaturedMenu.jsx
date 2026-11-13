import { ArrowUpRight } from 'lucide-react';
import { Link } from 'react-router-dom';
import { featuredDrinks } from '../../data/homeContent';

export default function FeaturedMenu() {
    return (
        <section aria-labelledby="featured-title" className="bg-cream py-16 md:py-26">
            <div className="mx-auto max-w-7xl px-5 md:px-6">
                <header className="mb-8 flex flex-col items-start gap-6 md:mb-12 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p className="text-[11px] font-semibold tracking-[0.17em] uppercase">
                            Find your favorite
                        </p>
                        <h2 id="featured-title" className="mt-4 font-display text-[clamp(2.15rem,3.5vw,3.4rem)] leading-tight font-medium tracking-tight">
                            A cup for <em className="text-caramel">every mood.</em>
                        </h2>
                    </div>
                    <Link to="/menu" className="inline-flex items-center gap-4 border-b py-2 text-sm font-medium transition-colors hover:text-caramel motion-reduce:transition-none">
                        Discover the menu
                        <ArrowUpRight size={19} aria-hidden="true" />
                    </Link>
                </header>

                <ul className="grid gap-10 md:grid-cols-3 md:gap-7">
                    {featuredDrinks.map((drink) => (
                        <li key={drink.name}>
                            <article>
                                <Link
                                    to="/menu"
                                    aria-label={'Explore ' + drink.name + ' on the menu'}
                                    className="group relative block aspect-[1/0.9] overflow-hidden rounded-2xl bg-beige md:aspect-[1/1.03]"
                                >
                                    <img
                                        src={drink.image}
                                        alt={drink.imageAlt}
                                        width="800"
                                        height="900"
                                        loading="lazy"
                                        className="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105 motion-reduce:transform-none motion-reduce:transition-none"
                                    />
                                    <span className="absolute right-4 bottom-4 grid size-11 place-items-center rounded-full bg-soft-white">
                                        <ArrowUpRight size={22} aria-hidden="true" />
                                    </span>
                                </Link>

                                <p className="mt-6 text-[10px] font-semibold tracking-[0.17em] text-muted uppercase">
                                    {drink.category}
                                </p>
                                <h3 className="mt-2 font-display text-3xl font-medium tracking-tight">
                                    <Link to="/menu">{drink.name}</Link>
                                </h3>
                                <p className="mt-3 text-sm leading-relaxed text-muted md:max-w-[330px]">
                                    {drink.description}
                                </p>
                            </article>
                        </li>
                    ))}
                </ul>
            </div>
        </section>
    );
}
