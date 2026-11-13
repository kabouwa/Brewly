import { PrimaryButton } from "../../components/ui/PrimaryButton";


export default function Menu() {
    return (
        <div className="max-w-7xl px-4 mx-auto ">
            <h3 className="text-4xl text-coffee">
                MENU PAGE SOON... 
                <PrimaryButton label={'go back'} to="/" classes="inline-flex ml-2" />
            </h3>
        </div>
    )
}