import { ArrowDown, ArrowUpRight, Coffee } from 'lucide-react';
import { PrimaryButton } from '../ui/PrimaryButton';
import { homeImages } from '../../data/homeContent';

export default function Hero() {
    return (
        <section id="hero" className="bg-cream pt-5 pb-10 md:pt-11 md:pb-18">
            <div className="mx-auto grid max-w-7xl items-center gap-8 px-5 md:grid-cols-2 md:gap-10 md:px-6 xl:gap-18">
                <div className="py-4 xl:py-8">
                    <p className="flex items-center gap-2.5 text-[11px] font-semibold tracking-[0.17em] uppercase">
                        <span aria-hidden="true" className="size-2 rounded-full bg-caramel" />
                        A little pause. A better cup.
                    </p>

                    <h1 className="mt-6 scroll-mt-8 font-display text-[clamp(3.1rem,6.3vw,6rem)] leading-[1.06] font-medium tracking-tight">
                        Good coffee.
                        <br />
                        <em className="text-caramel">Better moments.</em>
                    </h1>

                    <p className="mt-6 max-w-[420px] text-base leading-relaxed text-muted">
                        For slow mornings, long conversations, and everything in between.
                        Find a little comfort in your everyday cup.
                    </p>

                    <div className="mt-8 flex flex-wrap items-center gap-6 text-sm">
                        <PrimaryButton label="Explore the menu" to="/menu" Icon={ArrowUpRight} />
                        <a href="#about" className="inline-flex items-center gap-4 border-b py-2 font-medium transition-colors hover:text-caramel motion-reduce:transition-none">
                            Our story
                            <ArrowUpRight size={18} aria-hidden="true" />
                        </a>
                    </div>

                    <a href="#discover" className="mt-8 inline-flex items-center gap-3 text-xs text-muted md:mt-10 xl:mt-16">
                        <span className="grid h-10 w-8 place-items-center rounded-full border border-coffee text-coffee">
                            <ArrowDown size={17} aria-hidden="true" />
                        </span>
                        A little more about brewly
                    </a>
                </div>

                <figure className="relative mx-auto w-full max-w-[570px] pb-6">
                    <div className="aspect-[1/0.95] overflow-hidden rounded-t-[42%] rounded-b-2xl bg-beige md:aspect-[1/1.08] md:rounded-t-[46%]">
                        <img
                            src={homeImages.hero}
                            alt="A warm cup of coffee ready for a quiet coffee break"
                            width="700"
                            height="840"
                            fetchPriority="high"
                            className="h-full w-full object-cover"
                        />
                    </div>

                    <div className="absolute bottom-12 left-3 flex items-center gap-3.5 rounded-xl bg-soft-white px-5 py-4 shadow-xl shadow-espresso/5 md:bottom-16 md:-left-5 xl:-left-8 xl:px-6 xl:py-5">
                        <Coffee size={27} strokeWidth={1.5} aria-hidden="true" />
                        <div>
                            <p className="text-[9px] font-semibold tracking-[0.15em] text-muted uppercase">
                                The everyday ritual
                            </p>
                            <p className="mt-1 font-display text-base xl:text-lg">
                                A cup. A pause. Your moment.
                            </p>
                        </div>
                    </div>

                    <figcaption className="absolute right-0 bottom-0 text-[11px] text-muted">
                        A little coffee. A little calm.
                    </figcaption>
                </figure>
            </div>
        </section>
    );
}
