import { InputWithLabel } from '@/components/cyp/input-with-label';
import { SelectWithLabel } from '@/components/cyp/select-with-label';

export function DynamicForm({ schema }) {
    if (!schema?.sections || !Array.isArray(schema.sections)) {
        console.error('❌ Invalid form schema:', schema);
        return <p>Invalid schema</p>;
    }

    return (
        <form className="grid grid-cols-12 gap-4 px-12">
            {schema.sections.map((section, sIdx) => (
                <Section key={sIdx} section={section} />
            ))}
        </form>
    );
}

function Section({ section }) {
    return (
        <>
            {section.title && (
                <h3 className="col-span-12 mt-4 mb-2 text-lg font-semibold">
                    {section.title}
                </h3>
            )}

            {section.fields.map((field, idx) => renderField(field, idx))}
        </>
    );
}

function renderField(field, index) {
    const colSpan = field.col || 12;

    switch (field.type) {
        case 'text':
        case 'number':
        case 'date':
            return (
                <div key={index} className={`col-span-${colSpan}`}>
                    <InputWithLabel
                        label={field.label}
                        id={field.name}
                        placeholder={field.placeholder || ''}
                        col={colSpan}
                        type={field.type}
                        required={field.required}
                    />
                </div>
            );

        case 'select':
            return (
                <div key={index} className={`col-span-${colSpan}`}>
                    <SelectWithLabel
                        label={field.label}
                        id={field.name}
                        placeholder={field.placeholder || ''}
                        module={field.module}
                        dataKey={field.dataKey}
                        col={colSpan}
                        required={field.required}
                    />
                </div>
            );

        case 'textarea':
            return (
                <div key={index} className={`col-span-${colSpan}`}>
                    <label className="mb-1 block text-sm">{field.label}</label>
                    <textarea
                        id={field.name}
                        placeholder={field.placeholder || ''}
                        className="w-full rounded border p-2"
                        rows={4}
                        required={field.required}
                    ></textarea>
                </div>
            );

        default:
            return null;
    }
}
