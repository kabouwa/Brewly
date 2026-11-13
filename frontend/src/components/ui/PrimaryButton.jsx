import { Link } from "react-router-dom"

export function PrimaryButton({
    label,
    type = 'button',
    dark = true,
    Icon,
    classes = '',
    to = null,
    disabled = false,
    onClick,
    ...props
}) {
    const className = `py-3 px-5 rounded-4xl flex shrink-0 justify-center items-center gap-2 cursor-pointer transition-colors motion-reduce:transition-none focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-caramel ${dark ? 'bg-dark-coffee text-white hover:bg-coffee' : 'bg-white text-dark-coffee hover:brightness-90'} ${disabled ? 'pointer-events-none opacity-50' : ''} ${classes}`;
    const content = <>{label}{Icon && <Icon aria-hidden="true" className="shrink-0" />}</>;

    if (to !== null) {
        return (
            <Link
                {...props}
                to={to}
                className={className}
                aria-disabled={disabled || undefined}
                tabIndex={disabled ? -1 : props.tabIndex}
                onClick={(event) => {
                    if (disabled) event.preventDefault();
                    else onClick?.(event);
                }}
            >
                {content}
            </Link>
        );
    }

    return (
        <button {...props} type={type} onClick={onClick} disabled={disabled} className={className}>
            {content}
        </button>
    );
}
