import { images } from "../../data/images";
import { Link } from "react-router-dom";

export function Brand() {
    return(
        <Link to="/" aria-label="Brewly home" className="flex shrink-0 items-center gap-2 justify-center rounded-sm focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-caramel">
            <img src={images.logo} alt="" className="w-8 mt-1" />
            <span className="font-bold font-display text-3xl relative pr-3">
                brewly
                <span aria-hidden="true" className="w-2 h-2 bg-caramel rounded-full absolute right-1 bottom-1"></span>
            </span>
        </Link>
    )
}
