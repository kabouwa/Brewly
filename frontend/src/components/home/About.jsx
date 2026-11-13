import { ArrowUpRight, Bean } from 'lucide-react';
import { homeImages } from '../../data/homeContent';

export default function About() {
    return (
        <section id="about" aria-labelledby="about-title" className="scroll-mt-8 py-16 md:py-26">
            <div className="mx-auto grid max-w-7xl items-center gap-11 px-5 md:grid-cols-2 md:gap-16 md:px-6 xl:gap-25">
                <div className="relative mr-4 aspect-[1/0.95] rounded-2xl bg-beige md:mr-0 md:aspect-[1/1.13] md:max-h-[600px]">
                    <img
                        src={homeImages.about}
                        alt="A welcoming café interior with tables and warm natural light"
                        width="700"
                        height="800"
                        loading="lazy"
                        className="h-full w-full rounded-2xl object-cover"
                    />
                    <div className="absolute right-[-15px] bottom-6 flex size-28 flex-col items-center justify-center gap-3 rounded-full bg-beige text-center ring-8 ring-soft-white md:right-[-30px] md:bottom-10 md:size-34">
                        <Bean size={28} strokeWidth={1.4} aria-hidden="true" />
                        <p className="text-[9px] leading-relaxed font-semibold tracking-widest uppercase">
                            Good coffee.
                            <br />
                            Good company.
                        </p>
                    </div>
                </div>

                <div>
                    <header>
                        <p className="text-[11px] font-semibold tracking-[0.17em] uppercase">
                            A little about us
                        </p>
                        <h2 id="about-title" className="mt-4 font-display text-[clamp(2.15rem,3.5vw,3.4rem)] leading-tight font-medium tracking-tight">
                            Coffee is the start.
                            <br />
                            <em className="text-caramel">Connection is the point.</em>
                        </h2>
                    </header>

                    <p className="mt-6 text-[15px] leading-loose text-muted">
                        Brewly is built around a simple idea: everyday moments deserve
                        a little more care. That first sip, the conversation that runs
                        long, the welcome break from a busy day.
                    </p>
                    <p className="mt-6 text-[15px] leading-loose text-muted">
                        We’re here for the coffee lovers, the curious sippers, and
                        everyone who just needs a moment to themselves.
                    </p>

                    <div className="mt-8 border-t border-beige pt-6">
                        <p className="mb-4 font-display text-2xl italic">
                            Make yourself a little moment.
                        </p>
                        <a href="#contact" className="inline-flex items-center gap-4 border-b py-2 text-sm font-medium transition-colors hover:text-caramel motion-reduce:transition-none">
                            Keep in touch
                            <ArrowUpRight size={18} aria-hidden="true" />
                        </a>
                    </div>
                </div>
            </div>
        </section>
    );
}
