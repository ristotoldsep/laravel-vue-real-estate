export default {
    root: {
        class: [
            'relative',

            // Flexbox & Alignment
            'inline-flex',
            'align-bottom',

            // Size
            'w-[20px] h-[20px',

            // Misc
            'cursor-pointer',
            'select-none'
        ]
    },
    input: ({ props, state }) => ({
        class: [
            // Flexbox
            'flex justify-center items-center',

            // Size
            'w-[20px] h-[20px]',

            // Shape
            'border',
            'rounded-full',

            // Transition
            'transition duration-200 ease-in-out',

            // Colors
            {
                'text-surface-700': props.value !== props.modelValue && props.value !== undefined,
                'bg-primary-100': props.value !== props.modelValue && props.value !== undefined,
                'border-primary-200': props.value !== props.modelValue && props.value !== undefined,
                'border-primary-500': props.value == props.modelValue && props.value !== undefined,
                'bg-primary-500': props.value == props.modelValue && props.value !== undefined
            },

            // States
            {
                'hover:border-primary-300': !props.disabled,
                'outline-none outline-offset-0': !props.disabled && state.focused,
                'ring ring-primary-400/50': !props.disabled && state.focused,
                'opacity-60 cursor-default': props.disabled
            }
        ]
    }),
    icon: ({ props }) => ({
        class: [
            'block',

            // Shape
            'rounded-full',

            // Size
            'w-3',
            'h-3',

            // Colors
            'bg-surface-0 dark:bg-surface-900',

            // Conditions
            {
                'backface-hidden scale-10 invisible': props.value !== props.modelValue,
                'transform visible scale-[1.1]': props.value == props.modelValue
            },

            // Transition
            'transition duration-200'
        ]
    })
};
