import { apiPost } from '@/apis/axiosClient';
import { InputWithLabel } from '@/components/cyp/input-with-label';
import { SelectWithLabel } from '@/components/cyp/select-with-label';
import { Button } from '@/components/ui/button';

export function DynamicForm({ schema, submitTo }) {
    if (!schema?.sections || !Array.isArray(schema.sections)) {
        console.error('❌ Invalid form schema:', schema);
        return <p>Invalid schema</p>;
    }

    const handleSubmit = async (e) => {
        e.preventDefault(); // stop default HTML submission

        // collect all field values
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData.entries());

        try {
            const res = await apiPost(submitTo, data);
            console.log(
                'Form submitted:',
                JSON.stringify(data) + ' to ' + submitTo,
            );
        } catch (err) {
            console.error('Error submitting form:', err);
        }
    };

    return (
        <form className="grid grid-cols-12 gap-4 px-12" onSubmit={handleSubmit}>
            {schema.sections.map((section, sIdx) => (
                <Section key={sIdx} section={section} />
            ))}
            {schema.submit?.label && (
                <div className="col-span-12 mt-4">
                    <Button type="submit">{schema.submit.label}</Button>
                </div>
            )}
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
                        name={field.name}
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
                        name={field.name}
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
