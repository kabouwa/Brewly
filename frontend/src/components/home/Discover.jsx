import { moments } from "../../data/homeContent";

export default function Discover() {
    return (
        <section id="discover" aria-labelledby="discover-title" className="scroll-mt-8 py-16 md:py-26">
            <div className="mx-auto max-w-7xl px-5 md:px-6">
                <header className="mb-8 flex flex-col gap-6 md:mb-12 md:flex-row md:items-end md:justify-between md:gap-10">
                    <div>
                        <p className="text-[11px] font-semibold tracking-[0.17em] uppercase">
                            The Brewly way
                        </p>
                        <h2 id="discover-title" className="mt-4 font-display text-[clamp(2.15rem,3.5vw,3.4rem)] leading-tight font-medium tracking-tight">
                            More than a coffee.
                            <br />
                            <em className="text-caramel">A moment for you.</em>
                        </h2>
                    </div>
                    <p className="text-sm leading-relaxed text-muted md:max-w-[370px] md:text-base">
                        We like the simple things: a cup you look forward to,
                        a welcoming feeling, and a reason to slow down.
                    </p>
                </header>

                <ul className="grid divide-y divide-beige border-y border-beige md:grid-cols-3 md:divide-x md:divide-y-0">
                    {moments.map(({ Icon, title, description }, index) => (
                        <li key={title} className="py-6 md:px-6 md:py-9 md:first:pl-0 md:last:pr-0 xl:px-9">
                            <div className="mb-4 flex items-center justify-between text-caramel md:mb-6">
                                <Icon size={29} strokeWidth={1.4} aria-hidden="true" />
                                <span aria-hidden="true" className="text-[11px] text-muted">
                                    0{index + 1}
                                </span>
                            </div>
                            <h3 className="font-display text-[27px] font-medium tracking-tight">
                                {title}
                            </h3>
                            <p className="mt-3 text-sm leading-relaxed text-muted md:max-w-[300px]">
                                {description}
                            </p>
                        </li>
                    ))}
                </ul>
            </div>
        </section>
    );
}
