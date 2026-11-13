import { ArrowUp } from 'lucide-react';
import { Link } from 'react-router-dom';
import { Brand } from '../../ui/Brand';

export default function PublicFooter() {
    return (
        <footer className="bg-cream pt-11 pb-6">
            <div className="mx-auto max-w-[1288px] px-5 md:px-6">
                <div className="flex flex-col items-start justify-between gap-7 pb-8 md:flex-row md:items-center">
                    <div className="[&>a]:justify-start">
                        <Brand />
                        <p className="mt-2.5 text-xs text-muted">
                            Good coffee. Better moments.
                        </p>
                    </div>

                    <nav aria-label="Footer navigation">
                        <ul className="flex flex-wrap gap-6 text-sm [&_a:hover]:text-caramel md:gap-7">
                            <li>
                                <Link to="/menu">Menu</Link>
                            </li>
                            <li>
                                <a href="#discover">Discover</a>
                            </li>
                            <li>
                                <a href="#about">Our story</a>
                            </li>
                            <li>
                                <a href="#contact">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div className="flex flex-wrap justify-between gap-5 border-t border-beige pt-5 text-[11px] text-muted">
                    <p>© {new Date().getFullYear()} Brewly. All rights reserved.</p>
                    <a href="#home" className="inline-flex items-center gap-2">
                        Back to top
                        <ArrowUp size={13} aria-hidden="true" />
                    </a>
                </div>
            </div>
        </footer>
    );
}
