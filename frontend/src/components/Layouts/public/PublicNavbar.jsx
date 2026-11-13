import { useEffect, useRef, useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { ArrowUpRight, Menu, X } from 'lucide-react';
import { Brand } from '../../ui/Brand';
import { PrimaryButton } from '../../ui/PrimaryButton';
import { motion } from 'framer-motion';

const navigationLinks = [
    { label: 'Home', to: '/' },
    { label: 'Discover', to: '/#discover' },
    { label: 'Menu', to: '/menu' },
    { label: 'About', to: '/#about' },
    { label: 'Contact', to: '/#contact' },
];

function Navigation({ currentPath }) {
    const [isOpen, setIsOpen] = useState(false);
    const [isNavbarVisible, setIsNavbarVisible] = useState(true);
    const headerRef = useRef(null);
    const toggleRef = useRef(null);
    const navigationRef = useRef(null);

    const closeMenu = () => setIsOpen(false);

    useEffect(() => {
        // Clamp overscroll so reaching either page edge does not reverse direction.
        const getScrollY = () => {
            const maxY = Math.max(0, document.documentElement.scrollHeight - window.innerHeight);
            return Math.min(maxY, Math.max(0, window.scrollY));
        };

        let previousY = getScrollY();

        const handleScroll = () => {
            const currentY = getScrollY();

            if (currentY === previousY) return;

            const headerHeight = headerRef.current?.offsetHeight ?? 80;
            setIsNavbarVisible(currentY <= headerHeight || currentY < previousY);
            previousY = currentY;
        };

        window.addEventListener('scroll', handleScroll, { passive: true });

        return () => window.removeEventListener('scroll', handleScroll);
    }, []);


    useEffect(() => {
        if (!isOpen) return;

        const handleEscape = (event) => {
            if (event.key !== 'Escape') return;

            setIsOpen(false);
            toggleRef.current?.focus();
        };

        const handleOutsideInteraction = (event) => {
            if (!headerRef.current?.contains(event.target)) {
                setIsOpen(false);
            }
        };

        // Keep this query aligned with the Tailwind lg: breakpoint below.
        const desktopQuery = window.matchMedia('(min-width: 1024px)');
        const handleDesktopChange = (event) => {
            if (!event.matches) return;

            // The mobile toggle becomes hidden when desktop navigation appears.
            if (document.activeElement === toggleRef.current) {
                navigationRef.current?.querySelector('a')?.focus();
            }
            setIsOpen(false);
        };

        document.addEventListener('keydown', handleEscape);
        document.addEventListener('pointerdown', handleOutsideInteraction);
        document.addEventListener('focusin', handleOutsideInteraction);
        desktopQuery.addEventListener('change', handleDesktopChange);

        return () => {
            document.removeEventListener('keydown', handleEscape);
            document.removeEventListener('pointerdown', handleOutsideInteraction);
            document.removeEventListener('focusin', handleOutsideInteraction);
            desktopQuery.removeEventListener('change', handleDesktopChange);
        };
    }, [isOpen]);

    return (
        <header
            ref={headerRef}
            className={[
                'sticky top-0 z-50 border-b border-beige bg-soft-white text-coffee',
                'transition-transform duration-300 ease-out motion-reduce:transition-none',
                isNavbarVisible || isOpen ? 'translate-y-0' : '-translate-y-full',
                'has-[:focus-visible]:translate-y-0',
            ].join(' ')}
        >
            <div className="mx-auto flex h-20 max-w-7xl items-center justify-between gap-6 px-5 md:px-6">
                <Brand />

                <button
                    ref={toggleRef}
                    type="button"
                    aria-label={isOpen ? 'Close navigation' : 'Open navigation'}
                    aria-expanded={isOpen}
                    aria-controls="primary-navigation"
                    onClick={() => setIsOpen((wasOpen) => !wasOpen)}
                    className="inline-flex size-11 shrink-0 cursor-pointer items-center justify-center rounded-full border border-beige bg-cream transition-colors hover:bg-beige focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-caramel motion-reduce:transition-none lg:hidden"
                >
                    <motion.span animate={{ opacity: [0,1], rotate: [isOpen ? 180 : -180,0] }} transition={{ duration: 0.3, ease: 'easeInOut' }} key={isOpen ? 'close' : 'menu'}>
                        {isOpen ? (
                            <X size={21} strokeWidth={1.75} aria-hidden="true" />
                        ) : (
                            <Menu size={21} strokeWidth={1.75} aria-hidden="true" />
                        )}
                    </motion.span>
                </button>

                <motion.nav animate={{ opacity: [0,1], scaleY: [0,1] }} transition={{ duration: 0.3, ease: 'easeInOut' }} key={isOpen ? 'close' : 'menu'}
                    ref={navigationRef}
                    id="primary-navigation"
                    aria-label="Main navigation"
                    className={[
                        isOpen ? 'block' : 'hidden',
                        'absolute inset-x-4 top-[calc(100%+0.5rem)] max-h-[calc(100dvh-6rem)] overflow-y-auto rounded-2xl border border-beige bg-soft-white p-3 shadow-xl shadow-espresso/10',
                        'lg:static lg:ml-auto lg:block lg:max-h-none lg:overflow-visible lg:rounded-none lg:border-0 lg:bg-transparent lg:p-0 lg:shadow-none origin-top',
                    ].join(' ')}
                >
                    <ul className="flex flex-col gap-1 lg:flex-row lg:items-center lg:gap-5 xl:gap-7">
                        {navigationLinks.map(({ label, to }) => {
                            const isActive = currentPath === to;

                            return (
                                <li key={to}>
                                    <Link
                                        to={to}
                                        onClick={closeMenu}
                                        aria-current={isActive ? (to.includes('#') ? 'location' : 'page') : undefined}
                                        className={[
                                            'relative block rounded-lg px-4 py-3 text-sm font-medium transition-colors hover:bg-cream focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-caramel motion-reduce:transition-none',
                                            'lg:rounded-sm lg:px-0 lg:py-2 lg:hover:bg-transparent lg:hover:text-caramel',
                                            'after:absolute after:inset-x-0 after:bottom-0 after:hidden after:h-0.5 after:origin-left after:rounded-full after:bg-caramel after:transition-transform after:duration-200 hover:after:scale-x-100 motion-reduce:after:transition-none lg:after:block',
                                            isActive
                                                ? 'bg-cream text-coffee after:scale-x-100 lg:bg-transparent'
                                                : 'text-muted after:scale-x-0 hover:text-coffee',
                                        ].join(' ')}
                                    >
                                        {label}
                                    </Link>
                                </li>
                            );
                        })}

                        <li className="mt-2 border-t border-beige pt-3 lg:mt-0 lg:ml-3 lg:border-0 lg:pt-0 xl:ml-5">
                            <PrimaryButton
                                label="Manage"
                                to="/login"
                                Icon={ArrowUpRight}
                                classes="w-full text-sm lg:w-auto"
                                onClick={closeMenu}
                            />
                        </li>
                    </ul>
                </motion.nav>
            </div>
        </header>
    );
}

export default function PublicNavbar() {
    const { key, pathname, hash } = useLocation();

    useEffect(() => {        
        // Wait for the destination page to mount before finding its section.
        const frame = requestAnimationFrame(() => {
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const behavior = reducedMotion ? 'instant' : 'smooth';

            if (hash) {
                let sectionId = hash.slice(1);

                try {
                    sectionId = decodeURIComponent(sectionId);
                } catch {
                    // A malformed fragment can still match an element's literal id.
                }
                if (sectionId === 'home') {
                    window.scrollTo({ top: 0, behavior });
                }else{
                    document.getElementById(sectionId)?.scrollIntoView({ behavior });
                }
            } else if (pathname === '/') {
                window.scrollTo({ top: 0, behavior });
            }
        });

        return () => cancelAnimationFrame(frame);
    }, [key, pathname, hash]);

    // Reset disclosure state for every navigation, including browser Back/Forward.
    return <Navigation key={key} currentPath={`${pathname}${hash}`} />;
}
