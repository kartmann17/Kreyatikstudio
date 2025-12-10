import PublicLayout from '@/Layouts/PublicLayout';

export default function StaticPage({ content, seo }) {
    return (
        <PublicLayout seo={seo}>
            <div dangerouslySetInnerHTML={{ __html: content }} />
        </PublicLayout>
    );
}
