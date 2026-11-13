import Hero from '../../components/home/Hero';
import Discover from '../../components/home/Discover';
import FeaturedMenu from '../../components/home/FeaturedMenu';
import About from '../../components/home/About';
import Contact from '../../components/home/Contact';

export default function Home() {
    return (
        <div className="w-full overflow-x-clip bg-soft-white text-coffee [&_a:focus-visible]:outline-2 [&_a:focus-visible]:outline-offset-4 [&_a:focus-visible]:outline-caramel">
            <Hero />
            <Discover />
            <FeaturedMenu />
            <About />
            <Contact />
        </div>
    );
}
