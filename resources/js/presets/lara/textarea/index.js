export default {
    root: ({ context }) => ({
        class: [
            // Font
            'font-sans leading-none',

            // Spacing
            'm-0',
            'p-3',

            // Shape
            'rounded-none',

            // Colors
            'text-primary-600',
            'placeholder:text-primary-400',
            'bg-transparent',
            'border-0 border-b border-primary-200',

            // States
            {
                '': !context.disabled,
                'focus:outline-none focus:outline-offset-0 focus:ring focus:ring-primary-500/50': !context.disabled,
                'opacity-60 select-none pointer-events-none cursor-default': context.disabled
            },

            // Misc
            'appearance-none',
            'transition-colors duration-200'
        ]
    })
};
