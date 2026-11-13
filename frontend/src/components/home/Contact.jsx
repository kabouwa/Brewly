import { ArrowUpRight, Coffee } from 'lucide-react';
import { PrimaryButton } from '../ui/PrimaryButton';

export default function Contact() {
    return (
        <section id="contact" aria-labelledby="contact-title" className="scroll-mt-8 bg-dark-coffee py-14 text-cream md:pt-20 md:pb-21">
            <div className="mx-auto flex max-w-7xl flex-col items-center px-5 text-center md:px-6">
                <Coffee size={47} strokeWidth={1.2} aria-hidden="true" className="mb-6 text-[#d7ad85]" />

                <p className="text-[11px] font-semibold tracking-[0.17em] text-[#dfc8b5] uppercase">
                    Let’s talk coffee
                </p>
                <h2 id="contact-title" className="mt-5 font-display text-[clamp(2.2rem,4vw,3.8rem)] leading-tight font-medium tracking-tight">
                    Your next favorite
                    <br />
                    <em className="text-[#d7ad85]">is waiting to be discovered.</em>
                </h2>
                <p className="mt-6 max-w-[440px] text-sm leading-relaxed text-[#e2cebe]">
                    Get to know the drinks, find your kind of coffee,
                    and make your next break a good one.
                </p>

                <PrimaryButton
                    label="Find your next cup"
                    to="/menu"
                    Icon={ArrowUpRight}
                    dark={false}
                    classes="mt-7 text-sm"
                />
            </div>
        </section>
    );
}
